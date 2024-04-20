<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileNavigation extends CI_Controller {
    function __construct()
    {
        parent::__construct();
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
}