<?php

class Categories extends CI_Model{
    function __construct()
    {              
        $this->load->database();
    }

    public function addNew($new_category){
        $data= array(
            'CategoryName'=>$new_category
        );
        $this->db->insert('categories',$data);
    }

    public function getCategoryId($category){        
        $this->db->from('categories');
        $this->db->where('CategoryName',$category);
        $result = $this->db->get();
        return $result->row();
    }

    public function getCategories(){
        $query= $this->db->select('*')->from('categories')->get();
        return $query->result_array();
    }
}