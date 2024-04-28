<?php

class Comments extends CI_Model{
    function __construct()
    {              
        $this->load->database();
    }

    public function commentsList($data){
        $query= $this->db->select('comments.Comment, users.Username')->from('comments')->where('AnswerID',$data)->join('users','users.UserID= comments.UserID')->get();
        return $query->result_array();

    }

    public function getQComments($data){
        $query= $this->db->select('comments.Comment,users.Username')->from('comments')->where('QuestionID',$data)->join('users','users.UserID= comments.UserID')->get();
        return $query->result_array();
    }

    public function read_userCs($uid,$sort){
        $query = $this->db->select('*')->from('comments')->where('UserID',$uid);
        if($sort=='newest'){
            $query->order_by('CreationDate','DESC');
        }
        if($sort=='oldest'){
            $query->order_by('CreationDate','ASC');
        }
        $query= $query->get();
        return $query->result_array();
    }
}