<?php 

class Client_Model extends CI_Model{
    
    public function admin_login_check($email,$password) {
        
        $this->db->select('*');
        
        $this->db->from('users');
        $this->db->where('email',$email);
        $this->db->where('password',md5($password));
        
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
        
    }

    public function get_total_client($table, $conditions, $timeframe_condition, $search_data)
    {
        $this->db->select('*');
        $this->db->from($table);

        if ($conditions) {
            $this->db->where($conditions);
        }
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->num_rows();
    }


    public function get_client_details($limit, $start,$sortBy = 'created_at', $sortType = 'desc')
    {
        
        $this->db->select('*');

        $this->db->from('clients');   
        $this->db->order_by($sortBy, $sortType);
        $result = $this->db->get()->result_array();
        return $result;
    }

    
}

?>