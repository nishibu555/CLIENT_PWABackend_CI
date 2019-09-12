<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestimonialController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  
    $this->load->library('form_validation');  
    $this->load->model('Login_model');
    $this->load->model('Client_Model');
    $this->load->model('Testimonial_Model');
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

        $data['title'] = "Testimonial";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/testimonial/show', $data, true);
        $this->load->view('backend/admin_main_content', $data);

	}

    public function testimonial_list(){
     $post  = $this->input->post();
             $searchKey = $post['search']['value'];
        $conditions = '';
        $table = 'testimonial';
        $search_data = $searchKey;
        $total_data = $this->Testimonial_Model->get_total_testimonial($table, $conditions, $search_data);

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



        $all_testimonial = $this->Testimonial_Model->get_testimonial_details($limit, $start, $coumns[$sortBy], $sortType, $searchKey);
                // dd($all_testimonial);
        // $data['draw'] = (int)$post['draw'];
        $data['recordsFiltered'] = $ddd['meta']['total'];
        $data['recordsTotal'] = $ddd['meta']['total'];
        // $data['sEcho'] = 1;

        foreach ($all_testimonial as $testimonial) {
            $new_array = array();
            $new_array['id'] = $testimonial['id'];
            $new_array['name'] = $testimonial['name'];
            $new_array['details'] = $testimonial['details'];
            $new_array['status'] = $testimonial['status'];
            $new_array['created_at'] = date('Y-m-d', strtotime($testimonial['created_at']));
            // if($testimonial['show_hide'] == 0){
            // $new_array['show_hide'] = ' <a title="Show" id="showme_'.$testimonial['id'].'" onclick="showMe('.$testimonial['id'].')" class="btn"><i class="fas fa-eye-slash"></i></a>';
            // }else{
            //     $new_array['show_hide'] = ' <a title="Hide" id="hideme_'.$testimonial['id'].'" onclick="hideMe('.$testimonial['id'].')" class="btn"><i class="fas fa-eye"></i></a>';
            // }
            $new_array['action'] = '<a title="Edit"  href="testimonial/edit/'.$testimonial['id'].'" class="btn btn-info"><i class="far fa-edit"></i></a>'.' <a title="Delete" href="testimonial/delete/'.$testimonial['id'].'" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
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
        $data['main_content'] = $this->load->view('backend/testimonial/add', $data, true);
        $this->load->view('backend/admin_main_content', $data);
    }

    public function save(){

            $this->form_validation->set_rules('name', 'Name', 'required');
            // $this->form_validation->set_rules('phone', 'Phone', 'required');
            // $this->form_validation->set_rules('logo', 'Logo', 'required');
            $this->form_validation->set_rules('date', 'Date', 'required');
            $this->form_validation->set_rules('testimonial_text', 'Testimonial Text', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->add();
                }
                else
                {
                    $name = $this->input->post('name');
                    $date = $this->input->post('date');
                    $details = $this->input->post('testimonial_text');
                    $testimonial_image = $this->input->post('testimonial_image');

                       $insert_data = [
                            'name' => $name,
                            'date' => $date,
                            'details' => $details,
                            'image' => $testimonial_image,
                       ];

                       $this->Global_Model->insert('testimonial', $insert_data);

                       $this->session->set_flashdata('success', 'Data Added successfully');
                       redirect('testimonial');
                }


    }

    public function edit($id){
        $data = array();

        $condition = ['id'=>$id];
        $data['testimonial'] = $this->Global_Model->getRow('testimonial', $condition);

        $data['title'] = "Testimonial";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/testimonial/edit', $data, true);
        $this->load->view('backend/admin_main_content', $data);
    }


    public function update($id){

            $this->form_validation->set_rules('name', 'Name', 'required');
            // $this->form_validation->set_rules('phone', 'Phone', 'required');
            // $this->form_validation->set_rules('logo', 'Logo', 'required');
            $this->form_validation->set_rules('date', 'Date', 'required');
            $this->form_validation->set_rules('testimonial_text', 'Testimonial Text', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->edit($id);
                }
                else
                {
                    $name = $this->input->post('name');
                    $date = $this->input->post('date');
                    $details = $this->input->post('testimonial_text');
                    $testimonial_image = $this->input->post('testimonial_image');

                    if(isset($testimonial_image)){
                       $insert_data = [
                            'name' => $name,
                            'date' => $date,
                            'details' => $details,
                            'image' => $testimonial_image,
                       ];
                    }else{
                       $insert_data = [
                            'name' => $name,
                            'date' => $date,
                            'details' => $details,
                       ];
                    }
                    $condition = ['id'=>$id];
                       $this->Global_Model->update('testimonial', $condition, $insert_data);

                       $this->session->set_flashdata('success', 'Data Updated successfully');
                       redirect('testimonial');
                }


    }

    public function destroy($id){
        $table = "testimonial";
        $condition = ['id'=>$id];

        $this->Global_Model->delete($table,$condition);
         $this->session->set_flashdata('error', 'Data Deleted successfully');
         redirect('testimonial');
    }


    public function show_me($id){
        $table = "testimonial";
        $condition = [
            'id'=>$id,
        ];
        $data = [
            show_hide => 1,
        ];
        $this->Global_Model->update($table, $condition, $data);
    }

    public function hide_me($id){
        $table = "testimonial";
        $condition = [
            'id'=>$id,
        ];
        $data = [
            show_hide => 0,
        ];
        $this->Global_Model->update($table, $condition, $data);
    }

    public function image_upload(){
        $files = $_FILES;
        $filename = $_FILES['userfile']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $detectedType = mime_content_type($_FILES['userfile']['tmp_name']);
        //  $fileinfo = getimagesize($_FILES["userfile"]["tmp_name"]);
        // $width = $fileinfo[0];
        // $height = $fileinfo[1];
        // 
        

            if (isset($_FILES['userfile']) && $_FILES['userfile']['name']) {
                $sess_data['original_name'] = $_FILES['userfile']['name'];
                $config['upload_path'] = FCPATH . 'assets\uploads\testimonial';
                $config['overwrite'] = true; 
                $config['allowed_types'] = 'gif|jpg|png';
                $new_name = 'pm_'.time();
                $config['file_name'] =$new_name;
                $this->load->library('upload');
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('userfile')) {
                    // dd("Not Working");
                    $status = 'error';
                    $msg = $this->upload->display_errors('', '');

                    dd($msg);
                } else {
                         // dd(" Working");

                    $image_data = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['maintain_ratio'] = false;
                    $config['source_image'] = $image_data['full_path']; //get original image
                    // $config["width"] = 962;
                    // $config["height"] = 641;
                    $image_config['quality'] = "100%";
                    
                    // $config['x_axis'] = ($width-962)>0 ? ($width-962)/2 : 0;
                    // $config['y_axis'] = ($height-641)>0 ? ($height-641)/2 : 0;
                    // $config['-x_axis'] = ($width-962)>0 ? ($width-962)/2 : 0;
                    // $config['-y_axis'] = ($height-641)>0 ? ($height-641)/2 : 0;
                    // $this->load->library('image_lib', $config);
                    // $this->image_lib->crop();
                    // if (!$this->image_lib->crop()) {
                    //     $response['error'] = $this->image_lib->display_errors();
                    // }
                    $response['success'] = 'Upload successfully';
                    $response['file_name'] = $image_data['file_name'];
                    $sess_data['new_name'] = $response['file_name'];

                    $this->session->set_flashdata('port_file_info', $sess_data);
                    http_response_code(200);

                }
            }
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
    }

}
