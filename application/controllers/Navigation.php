<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    }

	public function profileQuestions()
	{
		$this->load->view('questions_asked');
	}

    public function questionslist()
	{   
        $this->load->view('questions_list');
	}

    public function askquestion()
	{   
        $this->load->view('ask_question');
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

}