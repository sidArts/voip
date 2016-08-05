<?php

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('layout');
        $this->layout->setHeader('header');
        $this->layout->setTitle('VoIP Wholesaler');
        $this->layout->setFooter('footer');
//      $this->layout->setDefaultCss(array(base_url().'assets/css/bootstrap.css'));
        $this->layout->setDefaultCss(array('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'));

        $this->layout->setDefaultJs(array(
            base_url().'assets/js/jquery.js',
            base_url().'assets/js/bootstrap.js'
        ));
    }

    public function check_session_exists() {
        if(!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('login-warning', 'Please signin to view content');
            redirect(base_url().'home/');
        }
    }
}