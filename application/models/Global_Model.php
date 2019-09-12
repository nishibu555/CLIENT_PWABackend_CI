<?php 

class Global_Model extends CI_Model{
    
    public function getAll($table) {
        
        $this->db->select('*');
        $this->db->from($table);
        $query_result = $this->db->get();
        $result = $query_result->result_array();
        return $result;
        
    }

    public function getRow($table, $condition){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $query_result = $this->db->get();
        $result = $query_result->result_array();
        return $result;
    }

    public function insert($table, $data){
    	$this->db->insert($table, $data);
    }

    public function update($table, $condition, $data){
        $this->db->where($condition);
        $this->db->update($table, $data);
    }

    public function delete($table, $condition){
        $this->db->where($condition);
        $this->db->delete($table);
    }

}

?>