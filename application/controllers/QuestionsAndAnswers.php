<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionsAndAnswers extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('Questions');
        $this->load->model('Categories');
        $this->load->library('session');
    }
	public function askQuestion()
	{
		$title= $this->input->post('q_title');
        $category= $this->input->post('q_category');
		$new_category= $this->input->post('new_category_name');
		$description= $this->input->post('q_desc');
		if($new_category!=''){
			$this->Categories->addNew($new_category);	
			$category=$new_category;
		}
		$categoryDetails=$this->Categories->getCategoryId($category);
		$categoryID=$categoryDetails->CategoryID;
		$userID=$this->session->userdata('userID');
		$this->Questions->postQuestion($title,$description,$userID,$categoryID);
		$this->load->view('homepage');
	}
}
