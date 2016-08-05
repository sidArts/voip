<?php
class Search extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
        $this->check_session_exists();
    }
    public function index() {
        $this->load->helper('form');
        $data = [];
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(empty($this->input->post('country')) && empty($this->input->post('category'))) {
                $data['results'] = $this->db->get('posts')->result();
            } else {
                $form = array(
                    "country" => $this->input->post('country'),
                    "post_type" => $this->input->post('category')
                );
                $data['results'] = $this->db->or_where($form)->get('posts')->result();
            }
        }
        $data['countries'] = $this->db->query('SELECT * FROM country')->result();
        $this->layout->render('frontend/search_form', $data);
    }

}