<?php
class Search extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
        $this->post_day_limit = $this->post_model->getPostDays();
        $this->check_session_exists();
        $this->load->helper('form');
    }
    public function index() {
        $date = date("Y-m-d", strtotime("-$this->post_day_limit day"));
        $data['results'] = $this->post_model->getAllWithUser(array('user_id !=' => $this->session->userdata('user_id')));
        $data['countries'] = $this->db->query('SELECT * FROM country')->result();
        $this->layout->render('frontend/search_form', $data);
    }
    public function compare($post_id) {
        if(empty($this->post_model->get($post_id))) {
            $this->show_404();
        }
        $data['results'] = $this->post_model->compare($post_id);
        $data['countries'] = $this->db->get('country')->result();
        $this->layout->render('frontend/search_form', $data);
    }
}