<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main_model extends CI_Model{
    public function check_email($email)
    {
        $this->db->select('*');
        $this->db->where('email', $email);
        // $this->db->where(array('email' => $email, 'password' => $password));
        $query = $this->db->get('users');
        if ( $query->num_rows() > 0 )
        {
            return true;
        }else{
            return false;
        }
    }
}