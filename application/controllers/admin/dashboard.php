<?php
class Dashboard extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->check_admin_session_exists();
        $this->load->library('layout');
        $this->layout->setHeader('admin_header');
        $this->layout->setTitle('VoIP Wholesaler - Admin');
        $this->layout->setFooter('admin_footer');
        $this->layout->setDefaultCss(array(
            base_url().'assets/css/sb-admin-2.css',
            base_url().'assets/css/metisMenu.css',
            'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'
        ));
        $this->layout->setDefaultJs(array(
            base_url().'assets/js/sb-admin-2.js',
            base_url().'assets/js/metisMenu.js',
        ));
    }
    public function index() {
        $this->layout->render('backend/dashboard');
    }

}