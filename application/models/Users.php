<?php

class Users extends CI_Model{
    var $encrypt_data;
    
    function __construct()
    {   
        $this->encrypt_data = array('method' => "AES-256-CBC",
        'key' => "encryptionKey123",
        'options' => 0,
        'iv' => '1234567891011121');            
        $this->load->database();
    }
    
    public function registerUser($username,$password) {
        $data=$this->encrypt_data;
        $encrypted_password= openssl_encrypt($password, $data['method'], $data['key'], $data['options'],$data['iv']);
        $data = array(
            'Username' => $username,
            'Password' => $encrypted_password
        );
        
        $this->db->insert('users', $data);
    }

    public function verifyLogin($username,$password){
        $data=$this->encrypt_data;
        $encrypted_password= openssl_encrypt($password, $data['method'], $data['key'], $data['options'],$data['iv']);
        $this -> db -> select('UserID, username, password');
        $this -> db -> from('users');
        $this -> db -> where('Username', $username);
        $this -> db -> where('Password', $encrypted_password);
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1)
        {
            $row=$query->row(0);
            return $row;
        }
        else
        {
            return NULL;
        }
    }

    public function delete($uid){
        $this->db->where('UserID', $uid);
        $this->db->delete('users');
    }
}