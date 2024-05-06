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

    public function login_user($email,$password)
    {
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

    function checkUserexist($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
          return true;
        }
        return false; 
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

    //******************************************************************************/

    public function add_room($table, $data){
        $insert=array(
            'room_name' => $data['Name'],
            'room_department' => $data['Department'],
            'room_capacity' => $data['Capacity'],
            'room_type' => $data['Type'],
        );
        $result = $this->db->insert($table, $insert);
		return $result;
    }

    public function get_room($table)
	{
		$result = $this->db->get($table)->result();
		return $result;
	}

    public function find_record_by_id($table, $id)
	{
		$result = $this->db->get_where($table, ['id' => $id])->row();
		return $result;
	}

    public function delete_by_id($table, $id)
	{
		$result = $this->db->delete($table, ['id' => $id]);
		return $result;
	}

    public function update_by_id($table, $data, $id)
	{
		$result = $this->db->where('id', $id)->update($table, $data);
		return $result;
	}

    //******************************************************************************/

    public function add_user($table, $data)
    {
        $insert=array(
            'name' => $data['Name'],
            'fullname' => $data['FullName'],
            'email' => $data['Email'],
            'password' => md5($data['Password']),
            'rank' => $data['Type'],
        );
        $result = $this->db->insert($table, $insert);
		return $result;
    }

    public function get_user($table)
	{
		$result = $this->db->get($table)->result();
		return $result;
	}
    
    public function find_user_by_id($table, $id)
	{
		$result = $this->db->get_where($table, ['id' => $id])->row();
		return $result;
	}

    public function delete_user_by_id($table, $id)
	{
		$result = $this->db->delete($table, ['id' => $id]);
		return $result;
	}


    public function update_user_by_id($table, $data, $id)
	{
		$result = $this->db->where('id', $id)->update($table, $data);
		return $result;
	}

    public function get_mastercode($module)
	{
        $result = $this->db->get_where("mastercode", ['module' => $module])->result();
		return $result;
	}

    public function add_booking($table, $data)
    {
        $startTime = $data['startTime'];
        $endTime = $data['endTime'];

        // Create a DateTime object using the time string
        $dateTime1 = DateTime::createFromFormat('g:i A', $startTime);
        $dateTime2 = DateTime::createFromFormat('g:i A', $endTime);

        // Format the DateTime object to 24-hour format
        $cstartTime = $dateTime1->format('H:i:s');
        $cendTime = $dateTime2->format('H:i:s');

        //echo $convertedTime; // Output: 15:45:00

        $insert=array(
            'create_dt' => date('Y-m-d H:i:s'),
            'start_dt' => $data['date'] . " " . $cstartTime,
            'end_dt' => $data['date'] . " " . $cendTime,
            'notes' => $data['notes'],
            'user_id' => $this->session->userdata('id'),
            'status' => "SUBMIT",
        );
        $result = $this->db->insert($table, $insert);
		return $result;
    }

    public function reset_pass($id)
    {
        $default_password_row = $this->get_mastercode('default_pass');
        $default_password = $default_password_row[0]->value;
        $hashed_default_password = md5($default_password);
        return $this->db->update('users', array('password' => $hashed_default_password), array('id' => $id));
    }
    
}