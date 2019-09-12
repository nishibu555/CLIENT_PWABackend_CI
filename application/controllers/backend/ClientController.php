<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientController extends CI_Controller {

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
	public function index()
	{
        $data = array();

        $data['title'] = "Clients";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/client_section/show', $data, true);
        $this->load->view('backend/admin_main_content', $data);

	}

    public function client_list(){

        $conditions = '';
        $timeframe_condition = '';
        $table = 'clients';
        $search_data = '';
        $total_data = $this->Client_Model->get_total_client($table, $conditions, $timeframe_condition, $search_data);

        $perpage = 10;
        $data = array();
        $data['meta']['page'] = 1;
        $data['meta']['pages'] = $total_data / $perpage;
        $data['meta']['perpage'] = $perpage;
        $data['meta']['total'] = $total_data;

        $start = 0;

        $limit = $data['meta']['perpage'];
        $sortBy = isset($post['sort']['field']) ? $post['sort']['field'] : 'created_at';
        $sortType = isset($post['sort']['sort']) ? $post['sort']['sort'] : 'desc';
        
        $all_client = $this->Client_Model->get_client_details($limit, $start, $sortBy, $sortType);
        

        foreach ($all_client as $client) {
            $new_array = array();
            $new_array['id'] = $client['id'];
            $new_array['name'] = $client['name'];
            $new_array['phone'] = $client['phone'];
            $new_array['website'] = $client['website'];
            $new_array['description'] = $client['description'];
            $new_array['created_at'] = date('Y-m-d', strtotime($client['created_at']));
            if($client['show_hide'] == 0){
            $new_array['show_hide'] = ' <a title="Show" id="showme_'.$client['id'].'" onclick="showMe('.$client['id'].')" class="btn"><i class="fas fa-eye-slash"></i></a>';
            }else{
                $new_array['show_hide'] = ' <a title="Hide" id="hideme_'.$client['id'].'" onclick="hideMe('.$client['id'].')" class="btn"><i class="fas fa-eye"></i></a>';
            }
            $new_array['action'] = '<a title="Edit"  href="client/edit/'.$client['id'].'" class="btn btn-info"><i class="far fa-edit"></i></a>'.' <a title="Delete" href="client/delete/'.$client['id'].'" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
           $data['data'][] = $new_array;
        }
        //        echo '<pre>';print_r($data['data']);die;
        echo json_encode($data);
    }

    public function add(){
        $data = array();

        $data['title'] = "Clients";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/client_section/add', $data, true);
        $this->load->view('backend/admin_main_content', $data);
    }

    public function save(){

            $this->form_validation->set_rules('full_name', 'Name', 'required');
            // $this->form_validation->set_rules('phone', 'Phone', 'required');
            // $this->form_validation->set_rules('logo', 'Logo', 'required');
            $this->form_validation->set_rules('website', 'Website', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->add();
                }
                else
                {
                    $full_name = $this->input->post('full_name');
                    $phone = $this->input->post('phone');
                    $logo = $this->input->post('logo');

                    $website = $this->input->post('website');
                    $description = $this->input->post('description');

                       $insert_data = [
                            'name' => $full_name,
                            'phone' => $phone,
                            'website' => $website,
                            'logo' => $logo,
                            'description' => $description,
                       ];

                       $this->Global_Model->insert('clients', $insert_data);

                       $this->session->set_flashdata('success', 'Data Added successfully');
                       redirect('clients');
                }


    }

    public function edit($id){
        $data = array();

        $condition = ['id'=>$id];
        $data['client'] = $this->Global_Model->getRow('clients', $condition);

        $data['title'] = "Clients";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/client_section/edit', $data, true);
        $this->load->view('backend/admin_main_content', $data);
    }


    public function update($id){

            $condition = ['id'=>$id];
            $this->form_validation->set_rules('full_name', 'Name', 'required');
            // $this->form_validation->set_rules('phone', 'Phone', 'required');
            // $this->form_validation->set_rules('logo', 'Logo', 'required');
            $this->form_validation->set_rules('website', 'Website', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->edit($id);
                }
                else
                {
                    $full_name = $this->input->post('full_name');
                    $phone = $this->input->post('phone');
                    $logo = $this->input->post('logo');
                    // $target_file = '';
                    // if($_FILES['logo']['name']){
                    // $logo = $_FILES['logo'];
                    //     $target_dir = "assets/uploads/";
                    //     $target_file = $target_dir . basename($_FILES["logo"]["name"]);
                    //     move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file);
                    // }
                    $website = $this->input->post('website');
                    $description = $this->input->post('description');

                    if($logo == ''){
                       $update_data = [
                            'name' => $full_name,
                            'phone' => $phone,
                            'website' => $website,
                            'description' => $description,
                       ];
                   }else{

                       $update_data = [
                            'name' => $full_name,
                            'phone' => $phone,
                            'website' => $website,
                            'logo' => $logo,
                            'description' => $description,
                       ];
                   }


                       $this->Global_Model->update('clients', $condition, $update_data);

                       $this->session->set_flashdata('success', 'Data Updated successfully');
                       redirect('clients');
                }


    }

    public function destroy($id){
        $table = "clients";
        $condition = ['id'=>$id];

        $this->Global_Model->delete($table,$condition);
         $this->session->set_flashdata('error', 'Data Deleted successfully');
         redirect('clients');
    }


    public function show_me($id){
        $table = "clients";
        $condition = [
            'id'=>$id,
        ];
        $data = [
            show_hide => 1,
        ];
        $this->Global_Model->update($table, $condition, $data);
    }

    public function hide_me($id){
        $table = "clients";
        $condition = [
            'id'=>$id,
        ];
        $data = [
            show_hide => 0,
        ];
        $this->Global_Model->update($table, $condition, $data);
    }

    public function image_upload(){
    $upload_path = 'assets\uploads\client_logo';
    $filename = 'userfile';
    $newname = $new_name = 'client_'.time();
    $imginfo = uploadImage($_FILES, $upload_path, $filename, $newname);

    echo $imginfo;
    }

}
