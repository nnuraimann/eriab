<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    private function hash_password($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function login_user($email,$password){
        $data=array(
        'email'=>$email,
        'password'=>$password);
        $query=$this->db->where($data);
        $login=$this->db->get('users');
         if($login!=NULL){
        return $login->row();
        }  
    }

    public function check_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function create_user($data) {

        // $data = array(
        //     'name' => $name,
        //     'email' => $email,
        //     'password' => $hashed_password,
        //     'date' => date('Y-m-d H:i:s'),
        //     'rank' => 'User'
        // );

        return $this->db->insert('users', $data);
    }

    public function get_hashed_password($email) {
        $this->db->select('password');
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        $row = $query->row();
        return ($query->num_rows() == 1) ? $row->password : false;
    }


    public function get_next_keytab_number() {
        $query = $this->db->get('keytab');
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $current_keytab_number = $row->key_num;
     
            $next_keytab_number = $current_keytab_number + 1;
     
            $this->db->update('keytab', array('key_num' => $next_keytab_number));
     
            return $next_keytab_number;
        } else {
            $next_keytab_number = 1;
            $this->db->insert('keytab', array('key_num' => $next_keytab_number));
            return $next_keytab_number;
        }
     }
}
