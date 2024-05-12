<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';
require APPPATH.'libraries/Format.php';
use chriskacerguis\RestServer\RestController;

class UserAPI extends RestController {
    public function __construct() {
        parent::__construct();        
        $this->load->library('session');
        $this->load->model('Answers');
        $this->load->model('Comments');
        $this->load->model('Questions');
        $this->load->model('Users');
    }

    function userAnswers_get()
    { 
        $uid=$this->session->userID;    

        $sort = $this->input->get('sort');
       
        $result = $this->Answers->read_userAs($uid,$sort);
        $this->response($result);
    }

    function userComments_get()
    { 
        $uid=$this->session->userID;    

        $sort = $this->input->get('sort');
       
        $result = $this->Comments->read_userCs($uid,$sort);

        foreach($result as $key=>$value){
            if($value['QuestionID']==null){
                $result[$key]['QuestionID']=$this->Answers->get_questionID($value['AnswerID']);
            }
        }
        $this->response($result);
    }

    function user_delete($data)
    {
        $uid=$this->session->userID; 
        $result = $this->Users->delete($uid);
        $this->load->view('homepage');
    }

    function upvoteAnswer_get(){
        $uid=$this->session->userID; 
        $id = $this->input->get('aID');
        $checkVote= $this->Answers->checkVote($uid,$id);
        if($checkVote==null){
            $response=$this->Answers->answerUpvote($id,$uid);
            $this->response($response);
        }
        elseif($checkVote[0]['VoteType']=='Downvote'){
            $response=$this->Answers->answerChangetoUpvote($id,$uid);
            $this->response($response);
        }

        else{
            $this->response(array('none'));
        }
    }

    function downvoteAnswer_get(){
        $id = $this->input->get('aID');
        $uid=$this->session->userID;
        $checkVote= $this->Answers->checkVote($uid,$id);
        if($checkVote==null){
            $response=$this->Answers->answerUpvote($id,$uid);
            $this->response($response);
        }
        elseif($checkVote[0]['VoteType']=='Upvote'){
            $response=$this->Answers->answerChangetoDownvote($id,$uid);
            $this->response($response);
        }

        else{
            $this->response(array('none'));
        }
    }

    function upvoteQuestion_get(){
        $id = $this->input->get('qID');
        $uid=$this->session->userID; 
        $checkVote= $this->Questions->checkVote($uid,$id);
        if($checkVote==null){
            $response=$this->Questions->questionUpvote($id,$uid);
            $this->response($response);
        }
        elseif($checkVote[0]['VoteType']=='Downvote'){
            $response=$this->Questions->changetoUpvote($id,$uid);
            $this->response($response);
        }

        else{
            $this->response(array('none'));
        }
    }

    function downvoteQuestion_get(){
        $id = $this->input->get('qID');
        $uid=$this->session->userID;  
        $checkVote= $this->Questions->checkVote($uid,$id);
        if($checkVote==null){
            $response=$this->Questions->questionDownvote($id,$uid);
            $this->response($response);
        }
        elseif($checkVote[0]['VoteType']=='Upvote'){
            $response=$this->Questions->changetoDownvote($id,$uid);
            $this->response($response);
        }

        else{
            $this->response(array('none'));
        }
    }

    function submitAnswer_post(){
        $uid=$this->session->userID;    
        $qID=$this->input->post('qID');
        $answer=$this->input->post('answer');
        $execution=$this->Answers->postAnswer($qID,$answer,$uid);
        $this->response($qID);
    }

    function deleteQuestion_post(){
        $qID=$this->input->post('qID');
        $delete=$this->Questions->deleteQ($qID);
        $this->response(array('done'));
    }

    function deleteAnswer_post(){
        $aID=$this->input->post('aID');
        $delete=$this->Answers->delete($aID);
        $this->response(array('done'));
    }

    function deleteComment_post(){
        $cID=$this->input->post('cID');
        $delete=$this->Comments->delete($cID);
        $this->response(array('done'));
    }

    public function userData_get(){
        $uid=$this->session->userID;
        // $uid=3;
        $details=$this->Users->getDetails($uid);
        $details[0]['created']=substr($details[0]['created'],0,10);
        $this->response($details[0]);
	}

}