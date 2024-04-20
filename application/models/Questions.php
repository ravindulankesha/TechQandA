<?php

class Questions extends CI_Model{
    function __construct()
    {              
        $this->load->database();
    }

    public function postQuestion($title,$description,$userID,$categoryID){
        $data= array(
            'Title'=>$title,
            'Description'=>$description,
            'UserID'=>$userID,
            'CategoryID'=>$categoryID,
            'votes'=>0
        );
        $this->db->insert('questions',$data);
    }
}