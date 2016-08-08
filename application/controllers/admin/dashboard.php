<?php
class Dashboard extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->check_admin_session_exists();
        $this->load->model('site_info_model');
    }
    public function index() {
        $this->layout->render('backend/dashboard');
    }
    public function siteinfo() {
        $data['site_info'] = $this->site_info_model->by('id', 1)->get();
        $this->layout->render('backend/site_info', $data);
    }

}