<?php
class Dashboard extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->check_admin_session_exists();
        $this->load->model('post_model');
        $this->post_day_limit = $this->post_model->getPostDays();
        $this->load->model('member_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="help-block alert-danger">', '</div>');
    }
    public function index() {
        if($this->input->post('post-days')):
            $this->form_validation->set_rules('post-days','Post Day Limit','required|integer');
            if($this->form_validation->run()):
                $this->post_model->updatePostDays($this->input->post('post-days'));
                redirect(base_url('admin/dashboard'));
            endif;
        endif;
        $date = date("Y-m-d", strtotime("-$this->post_day_limit day"));
        $data['post_count'] = $this->db->select('rate')
                                       ->from('posts')
                                       ->join('members','posts.user_id=members.id')
                                       ->where('posts.created_at >', $date)
                                       ->count_all_results();
        $data['post_day_limit'] = $this->post_day_limit;
        $data['member_count'] = $this->member_model->count_records();
        $this->layout->render('backend/dashboard', $data);
    }
    public function siteInfo() {
        $data['site_info'] = $this->site;
        $this->layout->render('backend/site_info', $data);
    }
    public function editInfo() {
        $this->form_validation->set_error_delimiters('<div class="help-block alert-danger">','</div>');
        if($this->input->post('submit')) {
            $this->form_validation->set_rules('title','Site Title','required');
            $this->form_validation->set_rules('name','Site Name','required');
            $this->form_validation->set_rules('email','Site Email','required');
            $this->form_validation->set_rules('phone','Phone','required');
            $this->form_validation->set_rules('about','Site About','required');
            if($this->form_validation->run() == TRUE) {
                $fields['site_title'] = $this->input->post('title');
                $fields['site_name'] = $this->input->post('name');
                $fields['site_email'] = $this->input->post('email');
                $fields['site_phone'] = $this->input->post('phone');
                $fields['site_about'] = $this->input->post('about');
                if(empty($_FILES['userfile']['name'])) {
                    $fields['site_homepage_image'] = $this->input->post('old-image');
                } else {
                    $upload_data = $this->uploadImage();
                    if(empty($upload_data['error'])) {
                        $fields['site_homepage_image'] = $upload_data['data']['file_name'];
                    }
                }
                if(!empty($upload_data['error'])) {
                    $data['upload_error'] = $upload_data['error'];
                } else {
                    if($this->site_info_model->update(1, $fields)) {
                        $this->session->set_flashdata('update-success','Site Information updated successfully!');
                    } else {
                        $this->session->set_flashdata('update-failure','Oops!..Something went wrong!..Please try again...');
                    }
                    redirect(base_url('admin/dashboard/siteInfo'));
                }
            }
        }
        $this->layout->setJs('http://cdn.ckeditor.com/4.5.10/standard/ckeditor.js');
        $data['site_info'] = $this->site;
        $this->layout->render('backend/edit_site_info', $data);
    }
    public function uploadImage(){
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload');
        $this->upload->initialize($config);
        if( !$this->upload->do_upload() ) {
            $data['error'] = $this->upload->display_errors();
        } else {
            $data['data'] = $this->upload->data();
        }
        return $data;
    }
    public function profile() {
        $this->load->model('admin_model');
        $data['admin'] = $this->admin_model->get($this->session->userdata('admin_id'));
        if ($this->input->post('submit')):
            $this->form_validation->set_rules('curr-pwd','Current Password','required');
            $this->form_validation->set_rules('new-pwd','New Password','required|min_length[4]');
            $this->form_validation->set_rules('conf-pwd','Confirm Password','required|matches[new-pwd]');
            if ($this->form_validation->run() == TRUE):
                $cur_pwd = $this->input->post('curr-pwd');
                $new_pwd = $this->input->post('new-pwd');
                if($data['admin']->password == sha1($cur_pwd)):
                    if($this->admin_model->update($data['admin']->id, ['password' => sha1($new_pwd)])):
                        $this->session->set_flashdata('pwd-update-success','Password Updated successfully!');
                    else:
                        $this->session->set_flashdata('pwd-update-fail','Oop!..Something went wrong!!');
                    endif;
                    redirect(base_url('admin/dashboard/profile'));
                else:
                    $data['error'] = 'Incorrect current password!';
                endif;
            endif;
        endif;
        $this->layout->render('backend/admin_profile', $data);
    }
}