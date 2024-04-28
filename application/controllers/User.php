<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

	public function login()
	{
        $username= $this->input->post('username'); 
        $password= $this->input->post('password');
		$verification_info=$this->Users->verifyLogin($username,$password);
        if($verification_info == NULL){
            $this->load->view('login');
        }
        else{
            $this->session->userdata=null;
            if($this->session->userdata==null){
                $this->session->userID=$verification_info->UserID;
                $this->session->username=$verification_info->username;
                $this->load->view('homepage');            
            }
        }
	}

    public function signup()
	{          
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.Username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');
        $username= $this->input->post('username');
        $password= $this->input->post('password');
        if($this->form_validation->run() == FALSE){
            $this->load->view('signup');
        }
        else{
            $this->Users->registerUser($username,$password);
            $this->load->view('login');
        }
	}

}