<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {
	public function __construct(){
		parent::__construct();
$this->load->library('upload');
        $user_id =  $this->session->userdata('user_id');
       
        if ($user_id == '') {
            redirect('admin/login');
        }
	}
	public function index()
	{
        $data = array();

        $data['title'] = "Dashboard";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/dashboard', $data, true);
        $this->load->view('backend/admin_main_content', $data);
	}
}
