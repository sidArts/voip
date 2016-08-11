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
        $date = date("Y-m-d", strtotime("-10 day"));
        $data['posts'] = $this->post_model
                        ->by('user_id', $this->session->userdata('user_id'))
                        ->by('created_at >',$date)
                        ->get_all();
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
                'rules' => 'required|numeric'
            ],
            [
                'field' => 'asr',
                'label' => 'ASR',
                'rules' => 'required|integer'
            ],
            [
                'field' => 'acd',
                'label' => 'ACD',
                'rules' => 'required|numeric'
            ],
            [
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'min_length[10]'
            ],
            [
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required'
            ]
        ];
        if($this->input->post('submit')) {
            $this->form_validation->set_rules($rules);
            if($this->form_validation->run() == TRUE) {
                $formfields = [
                    'post_type' => $this->input->post('post-type'),
                    'quality_level' => $this->input->post('quality'),
                    'description' => $this->input->post('description'),
                    'asr' => $this->input->post('asr'),
                    'acd' => $this->input->post('acd'),
                    'rate' => $this->input->post('rate'),
                    'country' => $this->input->post('country'),
                    'user_id' => $this->session->userdata('user_id')
                ];
                $post = $this->post_model->insert($formfields);
                if($post) {
                    $this->emailAddedPost($post);
                    $this->emailRelevantPosts($post);
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
        $this->check_if_postid_exist($id);
        if($this->input->post('submit')) {
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('description');
            $this->load->library('email');
            $this->email->to($email);
            $this->email->from($this->session->userdata('email'));
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
        $this->check_if_postid_exist($id);
        if($this->post_model->delete($id)) {
            $this->session->set_flashdata('post-del-flash','Post deleted!');
        } else {
            $this->session->set_flashdata('post-del-fail-flash','Oops! Somethong went wrong...');
        }
        redirect(base_url().'posts');
    }
    public function change_status($id) {
        $this->check_if_postid_exist($id);
        $query = $this->db->query("UPDATE posts SET status = IF(status = 1, 0, 1) WHERE id=$id");
        if($query) {
            $this->session->set_flashdata('status-flash','Post status changed successfully!');
        } else {
            $this->session->set_flashdata('status-flash','Oops!..Post status was not changed..Please try again!!');
        }
        redirect(base_url().'posts/');
    }
    public function check_if_postid_exist($id) {
        $data = $this->post_model->getWithUserId($id);
        if(empty($data)) {
            $this->show_404();
        }
        return $data;
    }
    public function emailAddedPost($post_id) {
        $post = $this->check_if_postid_exist($post_id);
        $this->load->library('parser');
        $this->load->library('email');
        $template = $this->parser->parse('frontend/email_new_post_tem', $post, TRUE);
        $this->email->to($post->email);
        $this->email->from($this->site->site_email, $this->site->site_name);
        $this->email->subject('Post Description');
        $this->email->message($template);
        $this->email->set_mailtype('html');
        $this->email->send();
    }
    public function emailRelevantPosts($post_id) {
        $post = $this->check_if_postid_exist($post_id);
        $data['posts'] = $this->post_model->compare($post_id);
        if(!empty($data['posts'])) {
            $this->load->library('parser');
            $this->load->library('email');
            $template = $this->parser->parse('frontend/email_relevant_posts_template', $data, TRUE);
            $this->email->to($post->email);
            $this->email->from($this->site->site_email, $this->site->site_name);
            $this->email->subject('Relevant Posts');
            $this->email->message($template);
            $this->email->set_mailtype('html');
            $this->email->send();
        }
    }
}