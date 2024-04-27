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
    }       
    function questions_get()
    {
        $data = array('filter' => $this->input->get('filter'),
            'sort' => $this->input->get('sort')
        );
        $result = $this->Questions->read_all($data);
        $this->response($result);
        var_dump($result);
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
}