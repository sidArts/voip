<?php
class Auth extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('member_model');
        $this->load->model('site_info_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->site = $this->db->get('site_info')->row();
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
    public function resetPassword($id = ''){
        if($this->session->userdata('admin_logged_in') == TRUE) {
            $this->session->set_flashdata('admin_login-warning', 'Please signin to view content');
            redirect(base_url().'admin/');
        }
        $member = $this->db->get_where('admin', array('id' => $id))->row();
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
                    $this->db->query('UPDATE `admin` SET `password`=? WHERE id=?',[sha1($pwd),$id]);
                    $this->session->set_flashdata('pwd-res-success', 'Your password was updated successfully!');
                    redirect(base_url('admin/auth/'));
                else:
                    $this->session->set_flashdata('pwd-res-fail', 'Invalid reset code!');
                    redirect(base_url('admin/auth/resetPassword/'.$id));
                endif;
            endif;
        endif;
        $this->load->view('backend/reset_pwd',array('member_id' => $member->id));
    }
    public function forgotPassword() {
        if($this->session->userdata('admin_logged_in') == TRUE) {
            $this->session->set_flashdata('admin_login-warning', 'Please signin to view content');
            redirect(base_url().'admin/');
        }
        if($this->input->post('submit')):
            $email = $this->input->post('email');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            if ($this->form_validation->run() == TRUE):
                $member = $this->db->get_where('admin', array('email' => $email))->row();
                if(!empty($member)):
                    $key = $this->generate_key();
                    $this->email->from($this->site->site_email,$this->site->site_name);
                    $this->email->to($member->email);
                    $this->email->subject('Reset Password');
                    $this->email->message("Email : $member->email, Enter this key : $key");
                    $this->email->send();
                    $this->session->set_flashdata('pwd-reset-flash','Please check your email..A reset code was sent..');
                    redirect(base_url('admin/auth/resetPassword/'.$member->id));
                else:
                    $this->session->set_flashdata('email-not-found-flash','Email not found');
                    redirect(base_url('admin/auth/'));
                endif;
            endif;
        endif;
        $this->load->view('backend/forgot_pwd');
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