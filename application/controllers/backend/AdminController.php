<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  
    $this->load->library('form_validation');  
    $this->load->model('Login_model');
    $this->load->model('Global_Model');
    $this->load->model('Admin_Model');
$this->load->library('upload');
        $user_id =  $this->session->userdata('user_id');
       
  }
	public function index()
	{
        $data = array();

        $data['title'] = "All Admin";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/admin_section/show', $data, true);
        $this->load->view('backend/admin_main_content', $data);

	}

    public function get_all_admin_data(){
     $post  = $this->input->post();
             $searchKey = $post['search']['value'];
        $conditions = '';
        $table = 'users';
        $search_data = $searchKey;
        $total_data = $this->Admin_Model->get_total_admin($table, $conditions, $search_data);

        $data = array();
        $ddd['meta']['page'] = 1;
        $ddd['meta']['pages'] = $total_data / $post['length'];
        $ddd['meta']['length'] = $post['length'];
        $ddd['meta']['total'] = $total_data;

        $start = 0;

        $limit = $ddd['meta']['length'];
        $sortBy = isset($post['sort']['field']) ? $post['sort']['field'] : 'created_at';
        $sortType = isset($post['sort']['sort']) ? $post['sort']['sort'] : 'desc';


        if (isset($post['start']) && $post['start']) {
            $ddd['meta']['page'] = $post['start'];
            $start = ($ddd['meta']['page'] * $ddd['meta']['length']) - $ddd['meta']['length'];
        }

        $coumns = ['created_at', 'name', 'details', 'status', 'created_at'];
        $limit = $ddd['meta']['length'];
        $sortBy = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : '0';
        $sortType = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'desc';



        $allAdmin = $this->Admin_Model->get_admin_details($limit, $start, $coumns[$sortBy], $sortType, $searchKey);
                // dd($allAdmin);
        // $data['draw'] = (int)$post['draw'];
        $data['recordsFiltered'] = $ddd['meta']['total'];
        $data['recordsTotal'] = $ddd['meta']['total'];
        // $data['sEcho'] = 1;

        foreach ($allAdmin as $admin) {
            $new_array = array();
            $new_array['id'] = $admin['id'];
            $new_array['first_name'] = $admin['first_name'];
            $new_array['last_name'] = $admin['last_name'];
            $new_array['email'] = $admin['email'];
            $new_array['username'] = $admin['username'];
            $new_array['created_at'] = date('Y-m-d', strtotime($admin['created_at']));
            // if($admin['show_hide'] == 0){
            // $new_array['show_hide'] = ' <a title="Show" id="showme_'.$admin['id'].'" onclick="showMe('.$admin['id'].')" class="btn"><i class="fas fa-eye-slash"></i></a>';
            // }else{
            //     $new_array['show_hide'] = ' <a title="Hide" id="hideme_'.$admin['id'].'" onclick="hideMe('.$admin['id'].')" class="btn"><i class="fas fa-eye"></i></a>';
            // }
            $new_array['action'] = '<a title="Edit"  href="'.base_url().'admin/edit/'.$admin['id'].'" class="btn btn-info"><i class="far fa-edit"></i></a>'.' <a title="Delete" href="'.base_url().'admin/delete/'.$admin['id'].'" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
           $data['data'][] = $new_array;
        }
        //        echo '<pre>';print_r($data['data']);die;
        echo json_encode($data);
    }
    public function create(){
        $data = array();

        $data['title'] = "All Admin";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/admin_section/add', $data, true);
        $this->load->view('backend/admin_main_content', $data);

    }

    public function save(){
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('user_name', 'Username', 'required|min_length[6]');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->create();
                }
                else
                {
                    $first_name = $this->input->post('first_name');
                    $last_name = $this->input->post('last_name');
                    $username = $this->input->post('user_name');
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');

                       $insert_data = [
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'username' => $username,
                            'email' => $email,
                            'password' => md5($password),
                            'type' => 1,
                       ];

                       $this->Global_Model->insert('users', $insert_data);

                       $this->session->set_flashdata('success', 'Data Added successfully');
                       redirect('admin/all');
                }

    }

    public function edit($id){
        $data = array();

        $data['title'] = "Edit Admin";
        $data['admin'] = $this->Global_Model->getRow('users', ['id'=>$id]);
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/admin_section/edit', $data, true);
        $this->load->view('backend/admin_main_content', $data);

    }


    public function update($id){
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('user_name', 'Username', 'required|min_length[6]');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->edit($id);
                }
                else
                {
                    $first_name = $this->input->post('first_name');
                    $last_name = $this->input->post('last_name');
                    $username = $this->input->post('user_name');
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');

                       $update_data = [
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'username' => $username,
                            'email' => $email,
                            'password' => md5($password),
                            'type' => 1,
                       ];

                       $this->Global_Model->update('users', ['id'=>$id], $update_data);

                       $this->session->set_flashdata('success', 'Data Updated successfully');
                       redirect('admin/all');
                }

    }



    public function destroy($id){
        $table = "users";
        $condition = ['id'=>$id];

        $this->Global_Model->delete($table,$condition);
         $this->session->set_flashdata('error', 'Data Deleted successfully');
         redirect('admin/all');
    }



public function profile(){
        $data = array();

        $data['title'] = "Admin Profile";

        $id = $this->session->userdata('user_id');
        $data['admin'] = $this->Global_Model->getRow('users', ['id'=>$id]);
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/profile/show', $data, true);
        $this->load->view('backend/admin_main_content', $data);
}


public function change_password(){
    $pass = $this->input->post('pass');

    $data = ['password'=>md5($pass]);
    $user_id = $this->session->userdata('user_id');
    $this->Global_Model->update('users',['id'=>$user_id], $data);
    $this->session->set_flashdata('success', 'Password Changed !');
    echo '1';
}
}
