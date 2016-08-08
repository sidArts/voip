<?php
class Posts extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->check_admin_session_exists();
        $this->load->model('post_model');
    }
    public function index() {
        $data['posts'] = $this->post_model->get_all();
        $this->layout->render('backend/all_posts', $data);
    }
    public function view($post_id) {
        $data['post'] = $this->post_model->getWithUserId($post_id);
        $this->layout->render('backend/single_post', $data);
    }
}