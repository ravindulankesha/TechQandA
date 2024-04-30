<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileNavigation extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Comments');
    }

	public function profileQuestions()
	{
		$this->load->view('questions_asked');
	}

    public function profileAnswers()
	{
		$this->load->view('answers');
	}

    public function profileComments()
	{
		$this->load->view('comments');
	}

	public function editComment(){
		$userID=$this->session->userdata('userID');
		$cid= $this->input->post('commentid');
		$text= $this->input->post('edit_comment');
		var_dump($userID,$cid,$text);
		// $this->Comments->editComment($userID,$cid,$text);
		// $this->load->view('comments');
	}
}