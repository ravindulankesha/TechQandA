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

    public function read_all($data){
        // $this -> db -> select('*');
        // $this->db->from('questions'),
        $query = $this->db->select('questions.QuestionID, questions.Title, questions.Votes,users.Username, categories.CategoryName')->from('questions');
        if($data['filter']!=''){
            $query->where('questions.CategoryID',($data['filter']));
        } 
        if($data['sort']=='newest'){
            $query->order_by('questions.CreationDate','DESC');
        }
        if($data['sort']=='oldest'){
            $query->order_by('questions.CreationDate','ASC');
        }
        if($data['sort']=='highest'){
            $query->order_by('questions.Votes','DESC');
        }
        if($data['sort']=='lowest'){
            $query->order_by('questions.Votes','ASC');
        }
        $query = $query->join('categories', 'categories.CategoryID= questions.CategoryID')
                ->join('users','users.UserID= questions.UserID')
                ->get();     
        return $query->result_array();
    }

    // public function get_filteredQs($sortParameter,$filterParameter){
    //     // $this -> db -> select('*');
    //     // $this->db->from('questions');
    //     // if($sortParameter){
    //     //     $
    //     // }
    //     $query = $this->db->select('*')->from('questions')
    //             ->join('categories', 'categories.CategoryID= questions.CategoryID')
    //             ->join('users','users.UserID= questions.UserID')
    //             ->get();     
    //     return $query->result_array();
    // }

    public function read_userQs($uid,$data){
        $query= $this->db->select('questions.QuestionID, questions.Title, questions.CreationDate, questions.Votes, categories.CategoryName')->from('questions')
                ->where('UserID',$uid);
                if($data['filter']!=''){
                    $query->where('questions.CategoryID',($data['filter']));
                } 
                if($data['sort']=='newest'){
                    $query->order_by('questions.CreationDate','DESC');
                }
                if($data['sort']=='oldest'){
                    $query->order_by('questions.CreationDate','ASC');
                }
                if($data['sort']=='highest'){
                    $query->order_by('questions.Votes','DESC');
                }
                if($data['sort']=='lowest'){
                    $query->order_by('questions.Votes','ASC');
                }
        $query=$query->join('categories', 'categories.CategoryID= questions.CategoryID')->get();
        return $query->result_array();
    }

    public function getQuestionsList($input){
        $query=$this->db->select('questions.QuestionID, questions.Title, questions.Votes,users.Username, categories.CategoryName')->from('questions')->like('Title',$input);
        $query = $query->join('categories', 'categories.CategoryID= questions.CategoryID')
                ->join('users','users.UserID= questions.UserID')->get();
        return $query->result_array();
    }

    public function getQDetails($data){
        $query=$this->db->select('questions.QuestionID, questions.Description, questions.CreationDate,questions.Title, questions.Votes,users.Username, categories.CategoryName')->from('questions')->where('QuestionID',$data);
        $query = $query->join('categories', 'categories.CategoryID= questions.CategoryID')
                ->join('users','users.UserID= questions.UserID')->get();
        return $query->result_array();
    }
}