<?php

	function dd($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		die();
	}

	function uploadImage($FILE=array(), $upload_path='', $file_name, $new_name)
        {

        $ci =& get_instance();

        $files = $FILE;
        $filename = $FILE[$file_name]['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $detectedType = mime_content_type($FILE[$file_name]['tmp_name']);
        //  $fileinfo = getimagesize($FILE["userfile"]["tmp_name"]);
        // $width = $fileinfo[0];
        // $height = $fileinfo[1];
        // 
        

            if (isset($FILE[$file_name]) && $FILE[$file_name]['name']) {
                $sess_data['original_name'] = $FILE[$file_name]['name'];
                $config['upload_path'] = FCPATH . $upload_path;
                $config['overwrite'] = true; 
                $config['allowed_types'] = 'gif|jpg|png';
                
                $config['file_name'] =$new_name;
                $ci->load->library('upload');
                $ci->upload->initialize($config);
                if (!$ci->upload->do_upload($file_name)) {
                    // dd("Not Working");
                    $status = 'error';
                    $msg = $ci->upload->display_errors('', '');

                    dd($msg);
                } else {
                         // dd(" Working");

                    $image_data = $ci->upload->data();
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

                    $ci->session->set_flashdata('port_file_info', $sess_data);
                    http_response_code(200);

                }
            }
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
        }

?>