<?php

class Answers extends CI_Model{
    function __construct()
    {              
        $this->load->database();
    }

    public function answers($data){
        $query= $this->db->select('answers.AnswerID,answers.Answer,answers.Votes,users.Username')->from('answers')->where('QuestionID',$data)->join('users','users.UserID= answers.UserID')->get();
        return $query->result_array();

    }

    public function answerCount($qID){
        $query= $this->db->select('*')->from('answers')->where('QuestionID',$qID)->get();
        return $query->num_rows();
    }

    public function read_userAs($uid,$sort){
        $query= $this->db->select('questions.QuestionID, answers.Answer, answers.Votes')->from('answers')->where('questions.UserID',$uid);
                if($sort=='newest'){
                    $query->order_by('answers.CreationDate','DESC');
                }
                if($sort=='oldest'){
                    $query->order_by('answers.CreationDate','ASC');
                }
                if($sort=='highest'){
                    $query->order_by('answers.Votes','DESC');
                }
                if($sort=='lowest'){
                    $query->order_by('answers.Votes','ASC');
                }
        $query=$query->join('questions', 'questions.QuestionID= answers.QuestionID')->get();
        return $query->result_array();
    }

}