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
                $this->db->where('created_at >',$date);
                $this->db->where('status', 1);
                $data['results'] = $this->db->get('posts')->result();
            } else {
                $this->db->where('created_at >',$date);
                $this->db->where('status', 1);
                $data['results'] = $this->db->where($form)->get('posts')->result();
            }
        } else {
            $data['results'] = $this->post_model
                ->by('created_at >',$date)
                ->by('status', 1)
                ->get_all();
        }
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