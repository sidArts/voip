<?php
class Search extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
        $this->check_session_exists();
        $this->load->helper('form');
    }
    public function index() {
        $date = date("Y-m-d", strtotime("-10 day"));
        $data['results'] = $this->post_model
            ->by('created_at >',$date)
            ->by('status', 1)
            ->get_all();
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