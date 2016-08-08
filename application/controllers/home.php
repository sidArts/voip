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
        if($this->input->post('submit')) {
            $firstname = $this->input->post('fname');
            $lastname = $this->input->post('lname');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            $this->email->to($this->site_email);
            $this->email->from($email);
            $this->email->subject($subject);
            $this->email->message($message);
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