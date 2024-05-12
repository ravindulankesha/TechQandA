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
        $this->load->model('Categories');
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
        foreach($result as $key=>$value){
            $result[$key]["answer_count"]=$this->Answers->answerCount($value['QuestionID']);
        }
        $this->response($result);
    }

    function questionComments_get(){
        $data = $this->input->get('qID');
        $comments=$this->Comments->getQComments($data);
        $this->response($comments);
    }

    function questionInfo_get(){
        $data = $this->input->get('qID');
        $sort = $this->input->get('sort');
        $answers = $this->Answers->answers($data,$sort);
        foreach($answers as $key=>$value){
            $answers[$key]["comments"]=$this->Comments->commentsList($value['AnswerID']);
        }
        $this->response($answers);
    }

    function questionCategories_get(){
        $categories=$this->Categories->getCategories();
        $this->response($categories);
    }

    function questionComment_post(){
        $data=array('name' => $this->input->post('name'),
        'pass' => $this->input->post('pass'),
        'type' => $this->input->post('type')
        );
    }

    function questionSearch_post(){
        $input= $this->input->post('searchInput');
        $response=$this->Questions->getQuestionsList($input);
        foreach($response as $key=>$value){
            $response[$key]["answer_count"]=$this->Answers->answerCount($value['QuestionID']);
        }
        $this->response($response);
    }

    function questionDetails_get(){
        $data = $this->input->get('qID');
        $sort = $this->input->get('sort');
        $qDetails = $this->Questions->getQDetails($data);
        $comments=$this->Comments->getQComments($data);
        $answers = $this->Answers->answers($data,$sort);
        foreach($answers as $key=>$value){
            $answers[$key]["comments"]=$this->Comments->commentsList($value['AnswerID']);
        }
        $qDetails['comments']=$comments;
        $qDetails['answers']=$answers;

        $this->response($qDetails);
    }
}