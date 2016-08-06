<?php
class Posts extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
        $this->load->helper('form');
        $this->load->library('parser');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="help-block alert-danger">','</div>');
        $this->check_session_exists();
    }
    public function index() {
        $this->db->order_by('created_at','desc');
        $data['posts'] = $this->post_model->by('user_id', $this->session->userdata('user_id'))->get_all();
        $view = $this->load->view('frontend/user_posts', $data, TRUE);
        $this->layout->render($view);
    }
    public function add() {
        $rules = [
            [
                'field' => 'post-type',
                'label' => 'Post Type',
                'rules' => 'required'
            ],
            [
                'field' => 'quality',
                'label' => 'Quality Level',
                'rules' => 'required'
            ],
            [
                'field' => 'rate',
                'label' => 'Rate',
                'rules' => 'required'
            ],
            [
                'field' => 'description',
                'label' => '',
                'rules' => 'min_length[10]'
            ],
            [
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required'
            ]
        ];
        $this->form_validation->set_rules($rules);
        if($this->input->post('submit')) {
            if($this->form_validation->run() == TRUE) {
                $formfields = [
                    'post_type' => $this->input->post('post-type'),
                    'quality_level' => $this->input->post('quality'),
                    'description' => $this->input->post('description'),
                    'asr' => $this->input->post('asr'),
                    'acd' => $this->input->post('acd'),
                    'country' => $this->input->post('country'),
                    'user_id' => $this->session->userdata('user_id')
                ];
                if($this->post_model->insert($formfields)) {
                    $this->session->set_flashdata('post-success','Post added successfully!');
                    redirect(base_url().'posts/');
                }
            }

        }
        $this->load->helper('form');
        $this->load->model('country_model');
        $countries = $this->country_model->get_all();
        $view = $this->parser->parse('frontend/add_post', ['countries' => $countries], true);
        $this->layout->render($view);
    }
    public function view($id) {
        if($this->input->post('submit')) {
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('description');
            $this->load->library('email');
            $this->email->to($email);
            $this->email->from($this->site_email);
            $this->email->subject($subject);
            $this->email->message($message);
            if($this->email->send()) {
                $this->session->set_flashdata('contact-mail-success','Your email has been sent!');
            } else {
                $this->session->set_flashdata('contact-mail-failure','Oops!..Something went wrong..Please try again!!');
            }
            redirect(base_url().'posts/view/'.$id);
        }
        $data['post'] = $this->post_model->getWithUserId($id);
        if($data['post']->user_id != $this->session->userdata('user_id')) {
            $view = $data['post']->views; $view++;
            $this->db->query("UPDATE posts SET views=$view WHERE id=$id");
        }
        $this->layout->render('frontend/post_details',$data);
    }
    public function delete($id) {
        if($this->post_model->delete($id)) {
            $this->session->set_flashdata('post-del-flash','Post deleted!');
        } else {
            $this->session->set_flashdata('post-del-fail-flash','Post deleted!');
        }
        redirect(base_url().'posts');
    }
    public function change_status($id) {
        $query = $this->db->query("UPDATE posts SET status = IF(status = 1, 0, 1) WHERE id=$id");
        if($query) {
            $this->session->set_flashdata('status-flash','Post status changed successfully!');
        } else {
            $this->session->set_flashdata('status-flash','Oops!..Post status was not changed..Please try again!!');
        }
        redirect(base_url().'posts/');
    }
}