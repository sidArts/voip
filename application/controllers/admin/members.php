<?php
class Members extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->check_admin_session_exists();
        $this->load->model('member_model');
    }
    public function index() {
        $data['members'] = $this->member_model->get_all();
        $this->layout->render('backend/all_members',$data);
    }
    public function info($id) {
        $data['member'] = $this->member_model->get($id);
        $this->layout->render('backend/single_member',$data);
    }
    public function sendMessage() {
        if($this->input->post('submit')) {
            $this->load->library('email');
            foreach ($_POST['email'] as $recipient) {
                $this->email->from($this->site_email);
                $this->email->to($recipient);
                $this->email->subject($this->input->post('subject'));
                $this->email->message($this->input->post('message'));
                if($this->email->send()) {
                    $this->session->set_flashdata('msg-sent-success', 'We have sent you a mail, please click the link provided to activate your account..');
                } else {
                    $this->session->set_flashdata('msg-sent-fail','Oops!..Email was not send...Click here to resend  <a class="btn btn-warning" href="'. base_url() .'users/activationEmail/'. $id .'">Resend email</a>');
                }
            }
            redirect(base_url().'admin/members');
        }
        $this->layout->setJs('http://cdn.ckeditor.com/4.5.10/standard/ckeditor.js');
        $this->layout->render('backend/compose_email');
    }
}