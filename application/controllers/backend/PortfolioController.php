<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PortfolioController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  
    $this->load->library('form_validation');  
    $this->load->model('Login_model');
    $this->load->model('Client_Model');
    $this->load->model('Portfolio_Model');
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

        $data['title'] = "Portfolio";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/portfolio/show', $data, true);
        $this->load->view('backend/admin_main_content', $data);

	}

    public function portfolio_list(){

        $conditions = '';
        $timeframe_condition = '';
        $table = 'portfolio';
        $search_data = '';
        $total_data = $this->Portfolio_Model->get_total_portfolio($table, $conditions, $timeframe_condition, $search_data);

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
        
        $all_portfolio = $this->Portfolio_Model->get_portfolio_details($limit, $start, $sortBy, $sortType);
        

        foreach ($all_portfolio as $portfolio) {
            $new_array = array();
            $new_array['id'] = $portfolio['id'];
            $new_array['title'] = $portfolio['title'];
            $new_array['website'] = $portfolio['website'];
            $new_array['technology'] = $portfolio['technology'];
            $new_array['description'] = $portfolio['description'];
            $new_array['created_at'] = date('Y-m-d', strtotime($portfolio['created_at']));
            if($portfolio['show_hide'] == 0){
            $new_array['show_hide'] = ' <a title="Show" id="showme_'.$portfolio['id'].'" onclick="showMe('.$portfolio['id'].')" class="btn"><i class="fas fa-eye-slash"></i></a>';
            }else{
                $new_array['show_hide'] = ' <a title="Hide" id="hideme_'.$portfolio['id'].'" onclick="hideMe('.$portfolio['id'].')" class="btn"><i class="fas fa-eye"></i></a>';
            }
            $new_array['action'] = '<a title="Edit"  href="portfolio/edit/'.$portfolio['id'].'" class="btn btn-info"><i class="far fa-edit"></i></a>'.' <a title="Delete" href="portfolio/delete/'.$portfolio['id'].'" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
           $data['data'][] = $new_array;
        }
        //        echo '<pre>';print_r($data['data']);die;
        echo json_encode($data);
    }

    public function add(){
        $data = array();

        $data['title'] = "Portfolio";
        $data['clients'] = $this->Global_Model->getAll('clients');
        $data['categories'] = $this->Global_Model->getAll('portfolio_category');
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/portfolio/add', $data, true);
        $this->load->view('backend/admin_main_content', $data);
    }

    public function save(){

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('website', 'Website Link', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('technology', 'Technology', 'required');
            $this->form_validation->set_rules('client', 'Client', 'required');
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('portfolio_main_image', 'Main Image', 'required');
            // $this->form_validation->set_rules('secondaryfile', 'Secondary Image', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->add();
                }
                else
                {
                    $title = $this->input->post('title');
                    $client = $this->input->post('client');
                    $website = $this->input->post('website');
                    $description = $this->input->post('description');
                    $technology = $this->input->post('technology');
                    $category = $this->input->post('category');
                    $mainImage = $this->input->post('portfolio_main_image');
                    $secondaryfile = $this->input->post('portfolio_secondary_image');


                       $insert_data = [
                            'title' => $title,
                            'client_id' => $client,
                            'website' => $website,
                            'technology' => $technology,
                            'category_id' => $category,
                            'description' => $description,
                       ];

                       $insert_id = $this->Portfolio_Model->insert('portfolio', $insert_data);
                     

                        $main_image = [];
                            $main_image = [
                                'portfolio_id'=>$insert_id,
                                'image'=>$mainImage,
                                'type' => 1
                            ];
                           $this->Global_Model->insert('portfolio_image', $main_image);
                       if(isset($secondaryfile)){
                        foreach ($secondaryfile as $secondary) {
                            $img_data = [];
                            $img_data = [
                                'portfolio_id'=>$insert_id,
                                'image'=>$secondary,
                                'type' => 0
                            ];
                           $this->Global_Model->insert('portfolio_image', $img_data);
                        }
                       }

                       $this->session->set_flashdata('success', 'Data Added successfully');
                       redirect('portfolio');
                }


    }

    public function edit($id){
        $data = array();

        $condition = ['id'=>$id];
        $data['portfoio'] = $this->Global_Model->getRow('portfolio', $condition);
        $condition1 = ['portfolio_id'=>$id, 'type'=>1];
        $data['main_image'] = $this->Global_Model->getRow('portfolio_image',$condition1);

        $condition2 = ['portfolio_id'=>$id, 'type'=>0];
        $data['secondary_image'] = $this->Global_Model->getRow('portfolio_image',$condition2);
        $data['clients'] = $this->Global_Model->getAll('clients');
        $data['categories'] = $this->Global_Model->getAll('portfolio_category');
        $data['title'] = "Portfolio";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/portfolio/edit', $data, true);
        $this->load->view('backend/admin_main_content', $data);
    }


    public function update($id){

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('website', 'Website Link', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('technology', 'Technology', 'required');
            // $this->form_validation->set_rules('portfolio_main_image', 'Main Image', 'required');
            // $this->form_validation->set_rules('secondaryfile', 'Secondary Image', 'required');
$category = $this->input->post('category');
                if ($this->form_validation->run() == FALSE)
                { $this->session->set_flashdata('error', 'Error occur');
                        $this->edit($id);
                }
                else
                {
                    $title = $this->input->post('title');
                    $client = $this->input->post('client');
                    $website = $this->input->post('website');
                    $description = $this->input->post('description');
                    $technology = $this->input->post('technology');
                    $mainImage = $this->input->post('portfolio_main_image');
                    $secondaryfile = $this->input->post('portfolio_secondary_image');


                       $update_data = [
                            'title' => $title,
                            'client_id' => $client,
                            'category_id'=>$category,
                            'website' => $website,
                            'technology' => $technology,
                            'description' => $description,
                       ];
                       $condition = ['id'=>$id];
                       $insert_id = $this->Global_Model->update('portfolio',$condition, $update_data);
                     
                       if(isset($mainImage)){
                        $main_image = [];
                            $main_image = [
                                'portfolio_id'=>$id,
                                'image'=>$mainImage,
                                'type' => 1
                            ];
                            
                           $this->Global_Model->insert('portfolio_image', $main_image);
                       }
                       if(isset($secondaryfile)){
                        foreach ($secondaryfile as $secondary) {
                            $img_data = [];
                            $img_data = [
                                'portfolio_id'=>$id,
                                'image'=>$secondary,
                                'type' => 0
                            ];
                           $this->Global_Model->insert('portfolio_image', $img_data);
                        }
                       }

                       $this->session->set_flashdata('success', 'Data Updated successfully');
                       redirect('portfolio');
                }

    }

    public function destroy($id){
        $table = "portfolio";
        $condition = ['id'=>$id];

        $this->Global_Model->delete($table,$condition);
         $this->session->set_flashdata('error', 'Data Deleted successfully');
         redirect('portfolio');
    }


    public function show_me($id){
        $table = "portfolio";
        $condition = [
            'id'=>$id,
        ];
        $data = [
            show_hide => 1,
        ];
        $this->Global_Model->update($table, $condition, $data);
    }

    public function hide_me($id){
        $table = "portfolio";
        $condition = [
            'id'=>$id,
        ];
        $data = [
            show_hide => 0,
        ];
        $this->Global_Model->update($table, $condition, $data);
    }


    public function main_image_upload(){
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
                $config['upload_path'] = FCPATH . 'assets\uploads\portfolio\main';
                $config['overwrite'] = true; 
                $config['allowed_types'] = 'gif|jpg|png';
                $new_name = 'pm_'.time();
                $config['file_name'] = $new_name;
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

                    $this->session->set_userdata('port_file_info', $sess_data);
                    http_response_code(200);

                }
            }
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
    }

    public function main_image_remove(){
        $file = $this->input->get('file');

        $stored_images = $this->session->userdata('port_file_info');
        unlink('assets/uploads/portfolio/main/' . $stored_images['new_name']);
        $this->session->unset_userdata('port_file_info');

    }

    // secondary image upload

    public function secondary_image_upload(){
        $files = $_FILES;
        $filename = $_FILES['secondaryfile']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $detectedType = mime_content_type($_FILES['secondaryfile']['tmp_name']);
        //  $fileinfo = getimagesize($_FILES["secondaryfile"]["tmp_name"]);
        // $width = $fileinfo[0];
        // $height = $fileinfo[1];
        // 
            if (isset($_FILES['secondaryfile']) && $_FILES['secondaryfile']['name']) {
                $sess_data['original_name'] = $_FILES['secondaryfile']['name'];
                $config['upload_path'] = FCPATH . 'assets\uploads\portfolio\secondary';
                $config['overwrite'] = true; 
                $config['allowed_types'] = 'gif|jpg|png';
                $new_name = 'ps_'.time();
                $config['file_name'] = $new_name;
                $this->load->library('upload');
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('secondaryfile')) {
                    // dd("Not Working");
                    $status = 'error';
                    $msg = $this->upload->display_errors('', '');

                } else {

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
                    // array_push($_SESSION['sec_file_info'], $sess_data);
                    // $_SESSION['sec_file_info'] = array();
                    $_SESSION['sec_file_info'][] = $sess_data;
                    http_response_code(200);

                }
            }
            // array_push($this->session->userdata('port_file_info'), sess_data);
        // $this->session->set_userdata('port_file_info', $sess_data);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
    }


    public function secondary_image_remove(){
        $file = $this->input->get('file');

        $stored_images = $_SESSION['sec_file_info'];
        foreach ($stored_images as $stored_image) {
            if($stored_image['original_name'] == $file){
                unlink('assets/uploads/portfolio/secondary/' . $stored_image['new_name']);  
                    $data = [];
                    $dat = $stored_image['new_name'];
                    $data = [
                        $dat,
                    ];
            $_SESSION['sec_file_info'] = array_diff($_SESSION['sec_file_info'], $data);

            }
        }
    }


    public function image_remove_from_server(){
        $id = $this->input->get('id');
        $img_name = $this->Global_Model->getRow('portfolio_image', ['id'=>$id]);
         $this->Global_Model->delete('portfolio_image', ['id'=>$id]);
         unlink('assets/uploads/portfolio/secondary/' . $img_name[0]['image']);
    }



    //Category Section
    public function allCategory(){
        $data = array();

        $data['title'] = "Portfolio Category";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/portfolio_category/show', $data, true);
        $this->load->view('backend/admin_main_content', $data);
    }

    public function get_category_data(){
        $conditions = '';
        $timeframe_condition = '';
        $table = 'portfolio_category';
        $search_data = '';
        $total_data = $this->Portfolio_Model->get_total_portfolio_category($table, $conditions, $timeframe_condition, $search_data);

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
        
        $portfolio_categories = $this->Portfolio_Model->get_portfolio_category_details($limit, $start, $sortBy, $sortType);
        

        foreach ($portfolio_categories as $cat) {
            $new_array = array();
            $new_array['id'] = $cat['id'];
            $new_array['name'] = $cat['name'];
            $new_array['created_at'] = date('Y-m-d', strtotime($cat['created_at']));


            $new_array['action'] = '<a title="Edit"  href="'.base_url().'portfolio/category/edit/'.$cat['id'].'" class="btn btn-info"><i class="far fa-edit"></i></a>'.' <a title="Delete" href="'.base_url().'portfolio/category/delete/'.$cat['id'].'" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
           $data['data'][] = $new_array;
        }
        //        echo '<pre>';print_r($data['data']);die;
        echo json_encode($data); 
    }

    public function category_add(){
        $data = array();

        $data['title'] = "Add Portfolio Category";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/portfolio_category/add', $data, true);
        $this->load->view('backend/admin_main_content', $data);
    }

    public function category_save(){

            $this->form_validation->set_rules('name', 'Category Name', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->category_add();
                }
                else
                {
                    $name = $this->input->post('name');
                    $slug = str_replace(" ", "_", $name);

                    $this->Global_Model->insert('portfolio_category', ['name'=>$name, 'slug'=>$slug]);
                       $this->session->set_flashdata('success', 'Data added successfully');
                       redirect('portfolio/category');
                }
    }

    public function category_edit($id){
        $data['category'] = $this->Global_Model->getRow('portfolio_category', ['id'=>$id]);

        $data['title'] = "Edit Portfolio Category";
        $data['header'] = $this->load->view('backend/template/header', $data, true);
        $data['footer'] = $this->load->view('backend/template/footer', $data, true);
        $data['main_content'] = $this->load->view('backend/portfolio_category/edit', $data, true);
        $this->load->view('backend/admin_main_content', $data);
    }

    public function category_update($id){

            $this->form_validation->set_rules('name', 'Category Name', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->category_add();
                }
                else
                {
                    $name = $this->input->post('name');
                    $slug = str_replace(" ", "_", $name);

                    $condition = ['id'=>$id];
                    $this->Global_Model->update('portfolio_category', $condition,['name'=>$name, 'slug'=>$slug]);
                       $this->session->set_flashdata('success', 'Data updated successfully');
                       redirect('portfolio/category');
                }
    }
    public function category_destroy($id){
        $table = "portfolio_category";
        $condition = ['id'=>$id];

        $this->Global_Model->delete($table,$condition);
         $this->session->set_flashdata('error', 'Data Deleted successfully');
         redirect('portfolio/category');
    }

}
