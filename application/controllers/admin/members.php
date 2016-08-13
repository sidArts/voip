<?php
class Members extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->check_admin_session_exists();
        $this->load->model('member_model');
    }
    public function index() {
        $this->load->helper('form');
        $this->load->library('email');
        if($this->input->post('submit')) {
            $this->email->from($this->site->site_email);
            $this->email->to($_POST['email']);
            $this->email->subject($this->input->post('subject'));
            $this->email->message($this->input->post('message'));
            $this->email->set_mailtype('html');
            if ($this->email->send()) {
                $this->session->set_flashdata('email-info', "Your message was successfully sent!");
            } else {
                $this->session->set_flashdata('email-info-warning', "Oop!..Something went wrong");
            }
            redirect(base_url().'admin/members');
        }
        $data['members'] = $this->member_model->get_all();
        $this->layout->setJs('http://cdn.ckeditor.com/4.5.10/standard/ckeditor.js');
        $this->layout->render('backend/all_members',$data);
    }
    public function info($id) {
        $data['member'] = $this->member_model->get($id);
        $this->layout->render('backend/single_member',$data);
    }
}