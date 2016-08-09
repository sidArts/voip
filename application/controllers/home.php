<?php

class Home extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    public function index() {
        $this->layout->render("frontend/about");
    }
    public function contact() {
        $this->load->library('email');
        $this->load->library('parser');
        if($this->input->post('submit')) {
            $data['name'] = $this->input->post('fname').' '.$this->input->post('lname');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['subject'] = $this->input->post('subject');
            $data['message'] = $this->input->post('message');
            $message = $this->parser->parse('frontend/contact_us_email_tem', $data, TRUE);
            $this->email->to($this->site->site_email);
            $this->email->from($data['email']);
            $this->email->subject($data['subject']);
            $this->email->message($message);
            $this->email->set_mailtype('html');
            if($this->email->send()) {
                $this->session->set_flashdata('contact-mail-success','Your email has been sent!');
            } else {
                $this->session->set_flashdata('contact-mail-failure','Oops!..Something went wrong..Please try again!!');
            }
            redirect(base_url().'home/contact');
        }
        $this->layout->render('frontend/contact_us');
    }

}

?>