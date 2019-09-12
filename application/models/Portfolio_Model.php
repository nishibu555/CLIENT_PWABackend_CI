<?php 

class Portfolio_Model extends CI_Model{

    public function get_total_portfolio($table, $conditions, $timeframe_condition, $search_data)
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


    public function get_portfolio_details($limit, $start,$sortBy = 'created_at', $sortType = 'desc')
    {
        
        $this->db->select('*');

        $this->db->from('portfolio');   
        $this->db->order_by($sortBy, $sortType);
        $result = $this->db->get()->result_array();
        return $result;
    }


    public function get_total_portfolio_category($table, $conditions, $timeframe_condition, $search_data)
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


    public function get_portfolio_category_details($limit, $start,$sortBy = 'created_at', $sortType = 'desc')
    {
        
        $this->db->select('*');

        $this->db->from('portfolio_category');   
        $this->db->order_by($sortBy, $sortType);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function insert($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
}

?>