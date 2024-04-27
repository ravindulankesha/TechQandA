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
       
        $result = $this->Comments->read_userCs(1,$sort);
        $this->response($result);
    }
    
}