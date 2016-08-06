<?php

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->site_email = 'sid94.dev@gmail.com';
        $this->load->library('layout');
        $this->layout->setHeader('header');
        $this->layout->setTitle('VoIP Wholesaler');
        $this->layout->setFooter('footer');
//      $this->layout->setDefaultCss(array(base_url().'assets/css/bootstrap.css'));
        $this->layout->setDefaultCss(array(
            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
            base_url().'assets/css/style.css',
            base_url().'assets/css/jquery.dataTables.min.css'
        ));
        $this->layout->setDefaultJs(array(
            base_url().'assets/js/jquery.js',
            base_url().'assets/js/bootstrap.js',
            base_url().'assets/js/jquery.dataTables.min.js'
        ));
    }

    public function check_session_exists() {
        if($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('login-warning', 'Please signin to view content');
            redirect(base_url().'home/');
        }
    }
    public function check_admin_session_exists() {
        if($this->session->userdata('admin_logged_in') == FALSE) {
            $this->session->set_flashdata('admin_login-warning', 'Please signin to view content');
            redirect(base_url().'admin/');
        }
    }
    public function show_404() {
        print $this->load->view('404','',true);
        exit;
    }
}