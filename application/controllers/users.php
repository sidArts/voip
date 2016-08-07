<?php

class Users extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->helper('form');
        $this->load->library("form_validation");
        $this->form_validation->set_error_delimiters('<div class="help-block alert-danger">','</div>');
    }
    public function index() {
        $this->check_session_exists();
        if($this->input->post('submit')) {
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('description');
            $this->load->library('email');
            $this->email->to($email);
            $this->email->from($this->session->userdata('email'));
            $this->email->subject($subject);
            $this->email->message($message);
            if($this->email->send()) {
                $this->session->set_flashdata('contact-mail-success','Your email has been sent!');
            } else {
                $this->session->set_flashdata('contact-mail-failure','Oops!..Something went wrong..Please try again!!');
            }
            redirect(base_url().'users');
        }
        $data['members'] = $this->member_model
                            ->by('is_verified', 1)
                            ->get_all();
        $this->layout->render('frontend/members_list',$data);
    }
    public function signup() {
        if($this->session->userdata('logged_in') == TRUE) {
            redirect(base_url().'home/');
        }
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
                    'company' => $this->input->post('company'),
                    'referral' => $this->input->post('referral')
                );
                if(!empty($this->input->post('country-code')) && !empty($this->input->post('phone'))) {
                    $form_fields['phone'] = $this->input->post('country-code').'-'.$this->input->post('phone');
                }
                $insert_id = $this->member_model->insert($form_fields);
                if($insert_id) {
                    $this->activationEmail($insert_id);
                }
            }
        }
        $this->load->model("country_model");
        $data['countries'] = $this->country_model->get_all();
        $this->layout->render('frontend/signup', $data);
    }

    public function activationEmail($id) {
        $user = $this->member_model->get($id);
        $this->load->library('email');
        $this->email->from($this->site_email,'VoIP Admin');
        $this->email->to($user->email);
        $this->email->subject('Voip - Activate your account');
        $hash = md5($user->email.$user->username);
        $this->email->message('Link : '.base_url().'users/verify/'.$id.'/'.$hash);
        if($this->email->send()) {
            $this->session->set_flashdata('signup-success', 'We have sent you a mail, please click the link provided to activate your account..');
        } else {
            $this->session->set_flashdata('signup-fail','Oops!..Email was not send...Click here to resend  <a class="btn btn-warning" href="'. base_url() .'users/activationEmail/'. $id .'">Resend email</a>');
        }
        redirect(base_url()."home");
    }

    public function verify($id, $hash) {
        $user = $this->member_model->get($id);
        $source = md5($user->email.$user->username);
        if($source == $hash && $this->member_model->update($id,array('is_verified' => 1)) == TRUE) {
            $this->session->set_flashdata('activation-success', 'Your account has been verified..You can now login!!');
        } else {
            $this->session->set_flashdata('activation-fail', 'Oops! verification failed...Please try again!');
        }
        redirect(base_url().'users/signin');
    }

    public function signin() {
        if($this->session->userdata('logged_in') == TRUE) {
            redirect(base_url().'home/');
        }
        if($this->input->post('submit')) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if($this->form_validation->run() == TRUE) {
                $form_fields = array(
                    'username' => $this->input->post('username'),
                    'password' => sha1($this->input->post('password'))
                );
                $user = $this->member_model->by('is_verified',1)->get($form_fields);
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
        $user_id = $this->session->userdata('user_id');
        $data['info'] = $this->member_model->get($user_id);
        $this->layout->render('frontend/user_info', $data);
    }
    public function updateProfile() {
        $this->check_session_exists();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="help-block alert-danger">','</div>');
        if($this->input->post('submit')) {
            $this->form_validation->set_rules('name','Name','required');
            $this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('country-code','Country Code','required');
            $this->form_validation->set_rules('phone','Phone','required');
            if($this->form_validation->run() == TRUE) {
                $form['name']     = $this->input->post('name');
                $form['username'] = $this->input->post('username');
                $form['email']    = $this->input->post('email');
                $form['phone']    = $this->input->post('country-code'). '-' .$this->input->post('phone');
                if($this->member_model->update($this->session->userdata('user_id'),$form)) {
                    $this->session->set_flashdata('prof-update-success', 'Your profile was updated successfully!');
                } else {
                    $this->session->set_flashdata('prof-update-failure', 'Oops!..Something went wrong!');
                }
                redirect(base_url().'users/settings');
            }
        }
        $this->load->model("country_model");
        $data['countries'] = $this->country_model->get_all();
        $data['profile'] = $this->member_model->get($this->session->userdata('user_id'));
        $this->layout->render('frontend/signup',$data);
    }
    public function settings() {
        $this->check_session_exists();
        $this->layout->render('frontend/member_settings');
    }
    public function deleteProfile() {
        $this->layout->render('frontend/delete_member');
    }
    public function updatePassword() {
        $this->layout->render('frontend/update_user_pwd');
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