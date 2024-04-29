<?php

class Answers extends CI_Model{
    function __construct()
    {              
        $this->load->database();
    }

    public function answers($data,$sort){
        $query= $this->db->select('answers.AnswerID,answers.Answer,answers.Votes,users.Username, answers.CreationDate')->from('answers')->where('QuestionID',$data);
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
        $query=$query->join('users','users.UserID= answers.UserID')->get();
        return $query->result_array();

    }

    public function answerCount($qID){
        $query= $this->db->select('*')->from('answers')->where('QuestionID',$qID)->get();
        return $query->num_rows();
    }

    public function read_userAs($uid,$sort){
        $query= $this->db->select('questions.QuestionID, answers.Answer, answers.Votes, answers.CreationDate')->from('answers')->where('answers.UserID',$uid);
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

    public function get_questionID($aID){
        $query=$this->db->select('QuestionID')->from('answers')->where('AnswerID',$aID)->get()->row();
        return $query->QuestionID;
    }

    public function answerUpvote($id){
        $this->db->set('Votes', 'Votes+1', false)->where('AnswerID' , $id)->update('answers');

        $query=$this->db->select("Votes")->from('answers')->where('AnswerID' , $id)->get();
        return $query->result_array();
    }

    public function answerDownvote($id){
        $this->db->set('Votes', 'Votes-1', false)->where('AnswerID' , $id)->update('answers');

        $query=$this->db->select("Votes")->from('answers')->where('AnswerID' , $id)->get();
        return $query->result_array();
    }

    public function postAnswer($qID,$answer,$uid){
        $data = array(
            'QuestionID' => $qID,
            'UserID' => $uid,
            'Answer' => $answer,
            'Votes' => 0
        );
        
        $this->db->insert('Answers', $data);
    }
}