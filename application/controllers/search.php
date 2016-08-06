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
        $date = date("Y-m-d", strtotime("-10 day"));
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!empty($this->input->post('country'))) {
                $form["country"] = $this->input->post('country');
            }
            if(!empty($this->input->post('category'))) {
                $form["post_type"] = $this->input->post('category');
            }
            if(!empty($this->input->post('quality-level'))) {
                $form['quality_level'] = $this->input->post('quality-level');
            }
            $form['created_at >'] = $date;
            if(empty($form)) {
                $data['results'] = $this->db->get('posts')->result();
            } else {
                $data['results'] = $this->db->where($form)->get('posts')->result();
            }
        } else {
            $data['results'] = $this->post_model
                ->by('created_at >',$date)
                ->get_all();
        }
        $data['countries'] = $this->db->query('SELECT * FROM country')->result();
        $this->layout->render('frontend/search_form', $data);
    }

}