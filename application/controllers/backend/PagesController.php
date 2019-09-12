<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PagesController extends CI_Controller {

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


  public function contact_us(){
        $data = array();

        $data['title'] = "Settings | Contact Us";
        $data['contact'] = $this->Global_Model->getRow('contact_us', ['id'=>1]);
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/pages/contact_us', $data, true);
        $this->load->view('backend/admin_main_content', $data);
  }

  public function update_contact_us($id){
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('fax', 'Fax', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('location', 'Location', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->contact_us();
                }else{

                    $phone = $this->input->post('phone');
                    $fax = $this->input->post('fax');
                    $email = $this->input->post('email');
                    $location = $this->input->post('location');

                    $upd_data = [
                        'phone'=>$phone,
                        'fax'=>$fax,
                        'email'=>$email,
                        'location'=>$location,
                    ];
                    $condition = ['id'=>1];

                    $this->Global_Model->update('contact_us', $condition, $upd_data);
                    $this->session->set_flashdata('success','Contact Us Settings updated!!!');
                    redirect('pages/contact');
                }
  }


  public function about_us(){
        $data = array();

        $data['title'] = "Settings | About Us";
        $data['about'] = $this->Global_Model->getRow('about_us', ['id'=>1]);
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/pages/about_us', $data, true);
        $this->load->view('backend/admin_main_content', $data);
  }

  public function update_about_us($id){
            $this->form_validation->set_rules('title', 'Title', 'required');
            // $this->form_validation->set_rules('aboutus_image', 'Image', 'required');
            $this->form_validation->set_rules('content', 'Content', 'required');


                if ($this->form_validation->run() == FALSE)
                {
                        $this->about_us();
                }else{

                    $title = $this->input->post('title');
                    $image = $this->input->post('aboutus_image');
                    $content = $this->input->post('content');
                    if($image){
                    $upd_data = [
                        'title'=>$title,
                        'image'=>$image,
                        'content'=>$content,
                    ];
                }else{
                    $upd_data = [
                        'title'=>$title,
                        'content'=>$content,
                    ];
                }
                    $condition = ['id'=>1];

                    $this->Global_Model->update('about_us', $condition, $upd_data);
                    $this->session->set_flashdata('success','Contact Us Settings updated!!!');
                    redirect('pages/about_us');
                }
  }

  public function about_us_image_upload(){
    $upload_path = 'assets\uploads\pages';
    $filename = 'userfile';
    $newname = $new_name = 'contact_'.time();
    $imginfo = uploadImage($_FILES, $upload_path, $filename, $newname);

    echo $imginfo;
  }
}
