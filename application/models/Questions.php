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

    public function questionUpvote($id,$uid){
        $data = array(
            'UserID' => $uid,
            'QuestionID' => $id,
            'VoteType' => 'Upvote'
        );
        
        $query1=$this->db->insert('Votes',$data);
        $query2=$this->db->set('Votes', 'Votes+1', false)->where('QuestionID' , $id)->update('questions');

        $query=$this->db->select("Votes")->from('questions')->where('QuestionID' , $id)->get();
        return $query->result_array();
    }

    public function questionDownvote($id,$uid){
        $data = array(
            'UserID' => $uid,
            'QuestionID' => $id,
            'VoteType' => 'Downvote'
        );
        
        $query1=$this->db->insert('Votes',$data);
        $query2=$this->db->set('Votes', 'Votes-1', false)->where('QuestionID' , $id)->update('questions');

        $query=$this->db->select("Votes")->from('questions')->where('QuestionID' , $id)->get();
        return $query->result_array();
    }

    public function submitComment($userID,$qid,$text){
        $data = array(
            'Comment' => $text,
            'QuestionID' => $qid,
            'UserID' => $userID
        );
        
        $this->db->insert('comments', $data);
    }

    public function checkVote($uid,$id){
        $array = array('UserID' => $uid, 'QuestionID' => $id);
        $query=$this->db->select('VoteType')->from('votes')->where($array)->get();
        return $query->result_array();
    }

    public function changetoUpvote($id,$uid){
        $array = array('UserID' => $uid, 'QuestionID' => $id);
        $data = array(
            'VoteType' => 'Upvote'
        );
        $query1=$this->db->where($array)->update('votes',$data);
        $query2=$this->db->set('Votes', 'Votes+2', false)->where('QuestionID' , $id)->update('questions');

        $query=$this->db->select("Votes")->from('questions')->where('QuestionID' , $id)->get();
        return $query->result_array();
    }
    public function changetoDownvote($id,$uid){
        $array = array('UserID' => $uid, 'QuestionID' => $id);
        $data = array(
            'VoteType' => 'Downvote'
        );
        $query1=$this->db->where($array)->update('votes',$data);
        $query2=$this->db->set('Votes', 'Votes-2', false)->where('QuestionID' , $id)->update('questions');

        $query=$this->db->select("Votes")->from('questions')->where('QuestionID' , $id)->get();
        return $query->result_array();
    }

    public function deleteQ($qID){
        $this->db->where('QuestionID', $qID)
                 ->delete('questions');
    }
}