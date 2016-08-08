<?php

class MY_Controller extends CI_Controller {
    protected $site;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('site_info_model');
        $this->site = $this->site_info_model->by('id', 1)->get();
        $this->load->library('layout');
        $this->layout->setDefaultCss(array(
            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
            'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
            base_url().'assets/css/jquery.dataTables.min.css'
        ));
        $this->layout->setDefaultJs(array(
            base_url().'assets/js/jquery.js',
            base_url().'assets/js/bootstrap.js',
            base_url().'assets/js/jquery.dataTables.min.js'
        ));
        if($this->uri->segment(1) == 'admin') {
            $this->layout->setTitle('VoIP Wholesaler - Admin');
            $this->layout->setHeader('admin_header');
            $this->layout->setFooter('admin_footer');
            $this->layout->setCss(base_url().'assets/css/metisMenu.css');
            $this->layout->setCss(base_url().'assets/css/sb-admin-2.css');
            $this->layout->setJs(base_url().'assets/js/sb-admin-2.js');
            $this->layout->setJs(base_url().'assets/js/metisMenu.js');
        } else {
            $this->layout->setTitle('VoIP Wholesaler');
            $this->layout->setHeader('header');
            $this->layout->setFooter('footer');
            $this->layout->setCss(base_url().'assets/css/style.css');
        }
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