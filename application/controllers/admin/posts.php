<?php
class Posts extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->check_admin_session_exists();
        $this->load->model('post_model');
        $this->post_day_limit = $this->post_model->getPostDays();
    }
    public function index() {
        $data['posts'] = $this->post_model->getAllWithUser();
        $this->layout->render('backend/all_posts', $data);
    }
    public function view($post_id) {
        $data['post'] = $this->post_model->getWithUserId($post_id);
        $this->layout->render('backend/single_post', $data);
    }
    public function delete($id) {
        $this->check_if_postid_exist($id);
        if($this->post_model->delete($id)) {
            $this->session->set_flashdata('post-del-flash','Post deleted!');
        } else {
            $this->session->set_flashdata('post-del-fail-flash','Oops! Somethong went wrong...');
        }
        redirect(base_url().'admin/posts');
    }
}