<?php
class Auth extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="help-block alert-danger">','</div>');
    }
    public function index() {
        if($this->session->userdata('admin_logged_in') == TRUE) {
            redirect(base_url().'admin/dashboard');
        }
        if($this->input->post('submit')) {
            $this->form_validation->set_rules('email','Email','trim|required|valid_email');
            $this->form_validation->set_rules('password','Password','required');
            if($this->form_validation->run() == TRUE) {
                $form['email'] = $this->input->post('email');
                $form['password'] = sha1($this->input->post('password'));
                $admin = $this->admin_model->get($form);
                if(!empty($admin)) {
                    $session_vars['admin_id'] = $admin->id;
                    $session_vars['admin_email'] = $admin->email;
                    $session_vars['admin_name'] = $admin->name;
                    $session_vars['admin_logged_in'] = TRUE;
                    $this->session->set_userdata($session_vars);
                    $this->session->set_flashdata('admin-login-success', 'Login success!');
                    redirect(base_url().'admin/dashboard');
                } else {
                    $this->session->set_flashdata('admin-login-failure', 'Failed! Incorrect Login Credentials!');
                    redirect(base_url().'admin/auth');
                }
            }
        }
        $this->load->view('backend/admin_signin');
    }
    public function logout() {
        if($this->session->userdata('admin_logged_in') == FALSE) {
            $this->session->set_flashdata('admin_login-warning', 'Please signin to view content');
            redirect(base_url().'admin/');
        }
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('admin_email');
        $this->session->set_userdata('admin_logged_in', FALSE);
        $this->session->set_flashdata('admin-logout-success', 'You are now looged out!');
        redirect(base_url().'admin');
    }
}