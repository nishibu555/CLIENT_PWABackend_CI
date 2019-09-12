<?php 

class Login_model extends CI_Model{
    
    public function admin_login_check($email,$password) {
        
        $this->db->select('*');
        
        $this->db->from('users');
        $this->db->where('email',$email);
        $this->db->where('password',md5($password));
        $this->db->where('type', 1);
        
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
        
    }

    public function checkinfo($id){
        $this->db->select("*");

        $this->db->from("project_warning_msg");
        $query= $this->db->where('user_id', $id);
        
        $query = $this->db->get()->row(); 
        return $query; 
    }

    public function insertInfo($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
   
    public function update($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->set('warning_date', $data);
        $this->db->update('project_warning_msg');
    }

        
}

?>