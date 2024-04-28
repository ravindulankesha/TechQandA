<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
		$this->load->model('Questions');
		$this->load->model('Answers');
		$this->load->model('Categories');
    }

	public function profileQuestions()
	{
		$this->load->view('questions_asked');
	}

    public function questionslist()
	{  
		$input= $this->input->post('searchInput');
        $response=$this->Questions->getQuestionsList($input);
		foreach($response as $key=>$value){
            $response[$key]["answer_count"]=$this->Answers->answerCount($value['QuestionID']);
        }
		$data["questions"]=$response;
        $this->load->view('questions_list',$data);
	}

    public function askquestion()
	{   
		$categories=$this->Categories->getCategories();
		$data['categories']=$categories;
		
        $this->load->view('ask_question',$data);
	}

    public function login()
	{
		$this->load->view('login');
	}

    public function signup()
	{   
        $this->load->view('signup');
	}

	public function logout(){
		$this->session->userID=null;
		$this->session->username=null;
		$this->load->view('homepage');
	}

	public function questionPage()
	{   
        $this->load->view('question_page');
	}


}