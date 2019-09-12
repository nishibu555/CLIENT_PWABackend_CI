<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLoginController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  
    $this->load->library('form_validation');  
    $this->load->model('Login_model');
$this->load->library('upload');
        $user_id =  $this->session->userdata('user_id');
       
        if ($user_id != '') {
            redirect('admin/dashboard');
        }
  }
	public function index()
	{
        $data = array();

        $data['title'] = "Login";
        $this->load->view('backend/login', $data);

	}

	public function check_login(){

		    $postdata = file_get_contents("php://input");
    		$request = json_decode($postdata);

		 $email = $request->email;
		 $password = $request->password;
		 // $remember = $request->remember;
	     $response = [];
	     if($email == ''){
	     	$response['email_err'] = "Email field must not be empty";
	     	$response['code'] = 0;
	     }
	      if($password == ''){
	     	$response['pass_err'] = "Password field must not be empty";
	     	$response['code'] = 0;
	     }
	     if ($email != '' && $password != '') {
	     	$login = $this->Login_model->admin_login_check($email, $password);

	     	if($login){
         		$response['success'] = "Suceess";
         		$response['code'] = 1;
         		$name_data = [
         			'user_name' => $login->username,
         			'user_id' => $login->id,
         		];
         		$this->session->set_userdata($name_data);
         	}else{

            	$response['incorrect_err'] = "Email or Password is  Incorrect";
            	$response['code'] = 0;
         	}
	     }

	     echo json_encode($response);
	
	}
}
