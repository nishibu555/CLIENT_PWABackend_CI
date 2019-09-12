<?php 

class Admin_Model extends CI_Model{
    
    public function get_total_admin($table, $conditions, $search_data)
    {
        $this->db->select('*');
        $this->db->from($table);

        if ($conditions) {
            $this->db->where($conditions);
        }
        if ($search_data) {
            $this->db->like("$table.name", $search_data);
        }
        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->num_rows();
    }


    public function get_admin_details($limit, $start,$sortBy = 'created_at', $sortType = 'desc', $search_data='')
    {
        
        
        $this->db->select('*');
        
        $this->db->from('users');
        
        if ($search_data) {
            $this->db->like('users.name', $search_data);
        }
        
        $this->db->order_by($sortBy, $sortType);
        $this->db->limit($limit, $start);
        
        $result = $this->db->get()->result_array();
//        dd($this->db->last_query());
        return $result;
    }



}

?>