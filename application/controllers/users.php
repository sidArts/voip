<?php

class Users extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('member_model');

    }
    public function index() {
        $this->check_session_exists();
        $data['members'] = $this->member_model->get_all();
        $this->layout->render('frontend/members_list',$data);
    }
    public function signup() {
        $this->load->library("form_validation");
        $this->load->helper('form');

        $this->form_validation->set_error_delimiters('<div class="help-block alert-danger">','</div>');

        $rules = array(
            array(
                "field" => "name",
                "label" => "Name",
                "rules" => "required"
            ),
            array(
                "field" => "email",
                "label" => "Email",
                "rules" => "required|valid_email|is_unique[members.email]"
            ),
            array(
                "field" => 'password',
                "label" => "Password",
                "rules" => 'required|matches[conf-password]|min_length[4]'
            ),
            array(
                "field" => 'conf-password',
                "label" => "Re-Type Password",
                "rules" => 'required'
            ),
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|min_length[5]|max_length[20]|alpha_dash'
            ),
            array(
                'field' => 'country-code',
                'label' => 'Country code',
                'rules' => 'required'
            ),
            array(
                'field' => 'phone',
                'label' => 'phone',
                'rules' => 'required|numeric|max_length[10]|min_length[10]'
            )
        );
        if($this->input->post('submit')) {
            $this->form_validation->set_rules($rules);

            if($this->form_validation->run() == TRUE) {
                $form_fields = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => sha1($this->input->post('password')),
                    'username' => $this->input->post('username'),
                    'phone' => $this->input->post('country-code').$this->input->post('phone'),
                    'company' => $this->input->post('company'),
                );
                if($this->member_model->insert($form_fields) == TRUE) {
                    $this->session->set_flashdata('signup-success', 'You row now a registered member!');
                    redirect(base_url()."home");
                }
            }
        }

        $this->load->library('parser');
        $this->load->model("country_model");
        $data = array('countries' => $this->country_model->get_all());
        $signup_page = $this->parser->parse('frontend/signup', $data, TRUE);

        $this->layout->render($signup_page, null,true);
    }

    public function signin() {
        $this->load->helper('form');
        $this->load->library("form_validation");
        $this->form_validation->set_error_delimiters('<div class="help-block alert-danger">','</div>');

        if($this->session->userdata('logged_in')) {
            $this->session->set_flashdata('already-logged', 'You are already logged in!');
            redirect(base_url().'home');
        }

        if($this->input->post('submit')) {

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if($this->form_validation->run() == TRUE) {
                $form_fields = array(
                    'username' => $this->input->post('username'),
                    'password' => sha1($this->input->post('password'))
                );
                $user = $this->member_model->get($form_fields);
                if($user) {
                    $session_data = array(
                        'user_id' => $user->id,
                        'username' => $user->username,
                        'name' => $user->name,
                        'email' => $user->email,
                        'logged_in' => true
                    );
                    $this->session->set_userdata($session_data);
                    $this->session->set_flashdata('signin-success', 'You have successfully logged in!');
                    redirect(base_url().'home');
                } else {
                    $this->session->set_flashdata('signin-failure', 'Oops! Invalid username or password');
                    redirect(base_url().'users/signin');
                }
            }
        }

        $this->layout->render('frontend/signin');
    }
    public function info() {
        $this->check_session_exists();
        $data['info'] = $this->member_model->get($this->session->userdata('user_id'));
        $this->layout->render('frontend/user_info', $data);
    }

    public function settings() {
        $this->check_session_exists();
    }
    public function logout() {
        $this->check_session_exists();
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->set_userdata('logged_in', FALSE);
        $this->session->set_flashdata('logout-success', 'You are now looged out!');
        redirect(base_url().'home');
    }
}