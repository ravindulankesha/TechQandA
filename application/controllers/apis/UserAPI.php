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

    
}