<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';
require APPPATH.'libraries/Format.php';
use chriskacerguis\RestServer\RestController;

class QuestionsAPI extends RestController {
    public function __construct() {
        parent::__construct();        
        $this->load->library('session');
        $this->load->model('Questions');
        $this->load->model('Users');
        $this->load->model('Answers');
        $this->load->model('Comments');
    }       
    function questions_get()
    {
        $data = array('filter' => $this->input->get('filter'),
            'sort' => $this->input->get('sort')
        );
        $result = $this->Questions->read_all($data);
        foreach($result as $key=>$value){
            $result[$key]["answer_count"]=$this->Answers->answerCount($value['QuestionID']);
        }
        $this->response($result);
    }

    function userQuestions_get()
    { 
        $uid=$this->session->userID;    

        $data = array('filter' => $this->input->get('filter'),
            'sort' => $this->input->get('sort')
        );
        $result = $this->Questions->read_userQs($uid,$data);
        $this->response($result);
    }

    function user_delete($data)
    {
        $uid=$this->session->userID; 
        $result = $this->Questions->delete($uid);
        $this->response($result);
    }

    function questionComments_get(){
        $data = $this->input->get('qID');
        $comments=$this->Comments->getQComments($data);
        $this->response($comments);
    }

    function questionInfo_get(){
        $data = $this->input->get('qID');
        $answers = $this->Answers->answers($data);
        foreach($answers as $key=>$value){
            $answers[$key]["comments"]=$this->Comments->commentsList($value['AnswerID']);
        }
        $this->response($answers);
        // var_dump($answersWithComments);
    }
}