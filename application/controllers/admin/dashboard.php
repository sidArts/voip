<?php
class Dashboard extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->check_admin_session_exists();
        $this->load->model('site_info_model');
        $this->load->model('post_model');
        $this->load->model('member_model');
    }
    public function index() {
        $data['post_count'] = $this->post_model->count_records();
        $data['member_count'] = $this->member_model->count_records();
        $this->layout->render('backend/dashboard', $data);
    }
    public function siteinfo() {
        $data['site_info'] = $this->site_info_model->by('id', 1)->get();
        $this->layout->render('backend/site_info', $data);
    }

}