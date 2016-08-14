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
                            ->by('id !=', $this->session->userdata('user_id'))
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
                "field" => 'referral',
                "label" => "Referred By",
                "rules" => 'email'
            ),
            array(
                'field' => 'terms',
                'label' => 'Terms & Conditions',
                'rules' => 'required'
            ),
            array(
                'field' => 'captcha',
                'label' => 'Captcha Text',
                'rules' => 'required'
            )
        );
        if($this->input->post('submit')) {
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == TRUE) {
                $captcha = $this->db->get_where('captcha',array('ip' => $this->input->ip_address()))->row();
                if($captcha->text == $this->input->post('captcha')) {
                    $form_fields = array(
                        'name' => $this->input->post('name'),
                        'email' => $this->input->post('email'),
                        'password' => sha1($this->input->post('password')),
                        'company' => $this->input->post('company'),
                        'referral' => $this->input->post('referral')
                    );
                    if (!empty($this->input->post('country-code')) && !empty($this->input->post('phone'))) {
                        $form_fields['phone'] = $this->input->post('country-code') . '-' . $this->input->post('phone');
                    }
                    $insert_id = $this->member_model->insert($form_fields);
                    if ($insert_id) {
                        $this->activationEmail($insert_id);
                    }
                } else {
                    $data['invalid_captcha'] = 'Invalid captcha text!!';
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
        $this->email->from($this->site->site_email);
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
        if($source == $hash && $this->member_model->update($id, array('is_verified' => 1)) == TRUE) {
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
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if($this->form_validation->run() == TRUE) {
                $email = $this->input->post('email');
                $password = sha1($this->input->post('password'));
                $binds = [$email, $password];
                $query = $this->db->query("SELECT * FROM `members` WHERE `email`=? AND `password`=?", $binds);
                $user = $query->row();
                if(!empty($user)) {
                    if($user->is_verified == 1) {
                        $session_data = array(
                            'user_id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'logged_in' => true
                        );
                        $this->session->set_userdata($session_data);
                        $this->session->set_flashdata('signin-success', 'Welcome '.$session_data['name'].'!..You have successfully logged in!');
                        redirect(base_url().'home');
                    } else {
                        $this->session->set_flashdata('activate-msg', 'Please activate your account to continue login or <a class="btn btn-warning btn-xs" href="'. base_url() .'users/activationEmail/'. $user->id .'">click here</a> to get activation email');
                        redirect(base_url().'users/signin');
                    }
                } else {
                    $this->session->set_flashdata('signin-failure', 'Oops! Invalid email or password');
                    redirect(base_url().'users/signin');
                }
            }
        }
        $this->layout->render('frontend/signin');
    }
    public function info() {
        $this->check_session_exists();
        $user_id = $this->session->userdata('user_id');
        $user = $this->member_model->get($user_id);
        if($this->input->post('submit')):
            $this->form_validation->set_rules('old-pwd','Current Password','required');
            $this->form_validation->set_rules('new-pwd','New Password','required|min_length[4]');
            $this->form_validation->set_rules('conf-new-pwd','Confirm Password','required|matches[new-pwd]|min_length[4]');
            if($this->form_validation->run() == TRUE):
                $curr_pwd = $this->input->post('old-pwd');
                $new_pwd = $this->input->post('new-pwd');
                if ($curr_pwd == $new_pwd):
                    $data['error'] = 'Current Password is same as new password';
                elseif (sha1($curr_pwd) != $user->password):
                    $data['error'] = 'Current is password is incorrect';
                else:
                    $this->member_model->update($user_id, ['password' => sha1($new_pwd)]);
                    $this->session->set_flashdata('password-update-success', 'Your password was updated successfully!');
                    redirect(base_url('users/info'));
                endif;
            endif;
        endif;
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
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('referral','Referred By','email');
            if($this->form_validation->run() == TRUE) {
                $form['name']     = $this->input->post('name');
                $form['email']    = $this->input->post('email');
                $form['company']  = $this->input->post('company');
                $form['referral'] = $this->input->post('referral');
                if(!empty($this->input->post('country-code')) && !empty($this->input->post('phone'))) {
                    $form_fields['phone'] = $this->input->post('country-code').'-'.$this->input->post('phone');
                }
                if($this->member_model->update($this->session->userdata('user_id'),$form)) {
                    $this->session->set_flashdata('prof-update-success', 'Your profile was updated successfully!');
                } else {
                    $this->session->set_flashdata('prof-update-failure', 'Oops!..Something went wrong!');
                }
                redirect(base_url().'users/info');
            }
        }
        $this->load->model("country_model");
        $data['countries'] = $this->country_model->get_all();
        $data['profile'] = $this->member_model->get($this->session->userdata('user_id'));
        $this->layout->render('frontend/signup',$data);
    }
    public function changeEmailVisibility() {
        $this->check_session_exists();
        $user_id = $this->session->userdata('user_id');
        $this->db->query("UPDATE `members` SET `email_visible` = IF(`email_visible`=0,1,0) WHERE id=$user_id");
        $this->session->set_flashdata('visibility-email', 'Your Email visibility was changed');
        redirect(base_url().'users/info');
    }
    public function changePhoneVisibility() {
        $this->check_session_exists();
        $user_id = $this->session->userdata('user_id');
        $this->db->query("UPDATE `members` SET `phone_visible` = IF(`phone_visible`=0,1,0) WHERE id=$user_id");
        $this->session->set_flashdata('visibility-phone', 'Your Phone visibility was changed');
        redirect(base_url().'users/info');
    }
    public function deactivateAccount() {
        $this->check_session_exists();
        $user_id = $this->session->userdata('user_id');
        $this->db->query("UPDATE `members` SET `is_verified`=0 WHERE id='$user_id'");
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('email');
        $this->session->set_userdata('logged_in', FALSE);
        $this->session->set_flashdata('deactivate-flash', 'Your account is now deactivated!');
        redirect(base_url());
    }
    public function deleteAccount() {
        $this->check_session_exists();
        $user_id = $this->session->userdata('user_id');
        $this->db->query("DELETE FROM `members` WHERE id='$user_id'");
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('email');
        $this->session->set_userdata('logged_in', FALSE);
        $this->session->set_flashdata('delete-acc-flash', 'Your account is deleted!');
        redirect(base_url());
    }
    public function logout() {
        $this->check_session_exists();
        $name = explode(' ',$this->session->userdata('name'))[0];
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('email');
        $this->session->set_userdata('logged_in', FALSE);
        $this->session->set_flashdata('logout-success', "Bye $name!.. You are now logged out!");
        redirect(base_url().'home');
    }
    public function gen_captcha_image() {
        //Initializing PHP variable with string
        $captchanumber = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
        //Getting first 6 word after shuffle
        $captchanumber = substr(str_shuffle($captchanumber), 0, 5);
        // saving captcha to DB
        $data = array(
            'ip' => $this->input->ip_address(),
            'time' => time(),
            'text' => $captchanumber
        );
        $expire = (time() - 3600);
        $this->db->query('DELETE FROM `captcha` WHERE `ip`=?',[$data['ip']]);
        $this->db->insert('captcha',$data);
        //Generating CAPTCHA
        $image = imagecreatefromjpeg(base_url('assets/images/bj.jpg'));
        $foreground = imagecolorallocate($image, 175, 199, 200); //font color
        imagestring($image, 5, 45, 8, $captchanumber, $foreground);
        header('Content-type: image/png');
        imagepng($image);
    }
    public function forgotPassword() {
        if($this->session->userdata('logged_in') == TRUE) {
            redirect(base_url().'home/');
        }
        if($this->input->post('submit')):
            $email = $this->input->post('email');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            if ($this->form_validation->run() == TRUE):
                $member = $this->db->get_where('members', array('email' => $email))->row();
                if(!empty($member)):
                    $this->load->library('email');
                    $key = $this->generate_key();
                    $this->email->from($this->site->site_email,$this->site->site_name);
                    $this->email->to($member->email);
                    $this->email->subject('Reset Password');
                    $this->email->message("Email : $member->email, Enter this key : $key");
                    $this->email->send();
                    $this->session->set_flashdata('pwd-reset-flash','Please check your email..A reset code was sent..');
                    redirect(base_url('users/resetPassword/'.$member->id));
                else:
                    $this->session->set_flashdata('email-not-found-flash','Email not found');
                    redirect(base_url('users/forgotPassword'));
                endif;
            endif;
        endif;
        $this->load->view('frontend/forgot_pwd');
    }
    public function resetPassword($id = ''){
        if($this->session->userdata('logged_in') == TRUE) {
            redirect(base_url().'home/');
        }
        $member = $this->db->get_where('members', array('id' => $id))->row();
        if(empty($member)) :
            print $this->load->view('404','',TRUE);
            exit;
        endif;
        if($this->input->post('submit')):
            $key = $this->input->post('key');
            $pwd = $this->input->post('new-pwd');
            $con_pwd = $this->input->post('conf-pwd');
            $this->form_validation->set_rules('key','Reset Key','required');
            $this->form_validation->set_rules('new-pwd','New Password','required|min_length[4]');
            $this->form_validation->set_rules('conf-pwd','Confirm Password','required|matches[new-pwd]');
            if($this->form_validation->run() == TRUE):
                $expiration = (time()-3600);
                $this->db->query("DELETE FROM `pwd_reset` WHERE `reset_time`<$expiration");
                $binds = [$this->input->ip_address(), $key];
                $query = $this->db->query("SELECT * FROM `pwd_reset` WHERE ip_address=? AND `reset_code`=?", $binds);
                if(!empty($query->row())):
                    $this->db->query('UPDATE `members` SET `password`=? WHERE id=?',[sha1($pwd),$id]);
                    $this->session->set_flashdata('pwd-res-success', 'Your password was updated successfully!');
                    redirect(base_url('users/signin'));
                else:
                    $this->session->set_flashdata('pwd-res-fail', 'Invalid reset code!');
                    redirect(base_url('users/resetPassword/'.$id));
                endif;
            endif;
        endif;
        $this->load->view('frontend/reset_pwd',array('member_id' => $member->id));
    }
    public function generate_key() {
        $captchanumber = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
        $key = substr(str_shuffle($captchanumber), 0, 5);
        $data = array(
            'reset_code' => $key,
            'ip_address' => $this->input->ip_address(),
            'reset_time' => time()
        );
        $this->db->query('DELETE FROM `pwd_reset` WHERE ip_address=?',[$data['ip_address']]);
        if($this->db->insert('pwd_reset',$data)):
            return $key;
        endif;
    }
}