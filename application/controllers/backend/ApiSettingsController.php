<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiSettingsController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  
    $this->load->library('form_validation');  
    $this->load->model('Login_model');
    $this->load->model('Client_Model');
    $this->load->model('Global_Model');
    $this->load->library('upload');
        $user_id =  $this->session->userdata('user_id');
       
        if ($user_id == '') {
            redirect('admin/login');
        }
  }


  public function recaptcha(){
        $data = array();

        $data['title'] = "Settings | Rechaptcha";
        $data['recap_data'] = $this->Global_Model->getRow('recaptcha_settings', ['id'=>1]);
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/settings/recaptcha', $data, true);
        $this->load->view('backend/admin_main_content', $data);
  }

  public function update_recaptcha($id){
            $this->form_validation->set_rules('public_key', 'Public key', 'required');

            $this->form_validation->set_rules('secret_key', 'Secrect Key', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->recaptcha();
                }else{

                    $public_key = $this->input->post('public_key');
                    $secret_key = $this->input->post('secret_key');

                    $upd_data = [
                        'public_key'=>$public_key,
                        'secret_key'=>$secret_key,
                    ];
                    $condition = ['id'=>1];

                    $this->Global_Model->update('recaptcha_settings', $condition, $upd_data);
                    $this->session->set_flashdata('success','Recaptcha settings updated!!!');
                    redirect('settings/recaptcha');
                }
  }


}
