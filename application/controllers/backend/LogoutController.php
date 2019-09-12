<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogoutController extends CI_Controller{
    
    public function index() {
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('type');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('plan_id');
        $this->session->unset_userdata('profile_photo');
        $this->session->sess_destroy();
        $this->load->helper('cookie');
        delete_cookie('user');
        redirect('admin/login');
    }
	

    
}
