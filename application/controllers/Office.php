<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Office extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name'))
        redirect('main');

        // load model
        $this->load->model('Main_model', 'dbMain');
    }

    public function index($data=false)
    {
        redirect('office/dashboard');
    }

    public function dashboard($data=false) 
    {
        $data['user'] = $this->session->userdata();
        $data['content'] = 'office/dashboard/main';
        $data['script'] = 'office/dashboard/script';
        $this->load->view('template/office/main', $data);
    }
    public function booking($data=false)
    {
        $data['user'] = $this->session->userdata();
        $data['content'] = 'office/booking/main';
        $data['script'] = 'office/booking/script';
        $this->load->view('template/office/main', $data);
    }

    public function room($data=false)
    {
        $data['user'] = $this->session->userdata();
        $data['content'] = 'office/room/main';
        $data['script'] = 'office/room/script';
        $this->load->view('template/office/main', $data);
    }

    public function classroom($data=false)
    {
        $data['user'] = $this->session->userdata();
        $data['content'] = 'office/classroom/main';
        $data['script'] = 'office/classroom/script';
        $this->load->view('template/office/main', $data);
    }

    public function room_setup($data=false)
    {
        $data['user'] = $this->session->userdata();
        $data['content'] = 'office/room_setup/main';
        $data['script'] = 'office/room_setup/script';
        $data['data'] = $this->dbMain->get_room('room');
        $this->load->view('template/office/main', $data);
    }

    public function room_create($data=false)
    {
        $data['user'] = $this->session->userdata();
        $data['jabatan'] = $this->dbMain->get_mastercode("user_department");
        $data['content'] = 'office/room_setup/create';
        $this->load->view('template/office/main', $data);
    }

    public function room_store($data=false)
    {
        $post=$this->input->post();
        // echo "<pre>", print_r($post), "</pre>";
        $this->dbMain->add_room('room', $post);
        return redirect('office/room_setup');

    }

    public function room_edit($id)
    {
        $data['data'] = $this->dbMain->find_record_by_id('room', $id);
        // echo "<pre>", print_r($post), "</pre>";
        $data['content'] = 'office/room_setup/edit';
        $this->load->view('template/office/main', $data);
    }

    public function room_delete($id)
	{
		$this->dbMain->delete_by_id('room', $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been deleted successfully.</div>');
        return redirect('office/room_setup');	
    }

    public function update_room($id)
	{
        
        $post=$this->input->post();
        $insert=array(
            'room_name' => $post['Name'],
            'room_department' => $post['Department'],
            'room_capacity' => $post['Capacity'],
            'room_type' => $post['Type'],
        );
        
		$this->dbMain->update_by_id('room', $insert, $id);
        
		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been updated successfully.</div>');
        return redirect('office/room_setup');	
	}

    public function user_setup($data=false)
    {
        $data['user'] = $this->session->userdata();
        $data['content'] = 'office/user_setup/main';
        $data['script'] = 'office/user_setup/script';
        $data['data'] = $this->dbMain->get_user('users');
        $this->load->view('template/office/main', $data);
    }

    public function user_create($data=false)
    {
        $data['user'] = $this->session->userdata();
        $data['content'] = 'office/user_setup/create';
        $this->load->view('template/office/main', $data);
    }

    public function user_store($data=false)
    {
        $post=$this->input->post();
        // echo "<pre>", print_r($post), "</pre>";
        $this->dbMain->add_user('users', $post);
        return redirect('office/user_setup');

    }

    public function user_edit($id)
    {
        $data['data'] = $this->dbMain->find_user_by_id('users', $id);
        // echo "<pre>", print_r($post), "</pre>";
        $data['content'] = 'office/user_setup/edit';
        $this->load->view('template/office/main', $data);
    }

    public function user_delete($id)
	{
		$this->dbMain->delete_user_by_id('users', $id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been deleted successfully.</div>');
        return redirect('office/user_setup');	
    }

    // public function user_pass_reset($id)
	// {
	// 	$this->dbMain->reset_pass('users', $id);
	// 	$this->session->set_flashdata('message', '<div class="alert alert-success">Password has been reset successfully.</div>');
    //     return redirect('office/user_setup');	
    // }

    public function update_user($id)
	{
        
        $post=$this->input->post();
        $insert=array(
            'name' => $post['Name'],
            'fullname' => $post['FullName'],
            'email' => $post['Email'],
            'password' => $post['Password'],
            'rank' => $post['Type'],
        );
        
		$this->dbMain->update_user_by_id('users', $insert, $id);
        
		$this->session->set_flashdata('message', '<div class="alert alert-success">Record has been updated successfully.</div>');
        return redirect('office/user_setup');	
	}

    public function profile($data=false)
    {
        $data['user'] = $this->session->userdata();
        $data['content'] = 'office/profile/main';
        $data['script'] = 'office/profile/script';
        $this->load->view('template/office/main', $data);
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->sess_destroy();
        return redirect('main');
    }

    public function submit_booking($data=false)
    {
        $this->load->library('form_validation');
        $post=$this->input->post();


        $this->form_validation->set_data($post);
        $this->form_validation->set_rules('date', 'create_dt', 'required');
        $this->form_validation->set_rules('startTime', 'start_dt', 'required');
        $this->form_validation->set_rules('endTime', 'end_dt', 'required');

        $status = TRUE;
        if ($this->form_validation->run() == FALSE) {
            $status = FALSE;
            $msg='Form unsuccessful';
        } else{
            $startTime = $post['startTime'];
            $endTime = $post['endTime'];

            // Create a DateTime object using the time string
            $dateTime1 = DateTime::createFromFormat('g:i A', $startTime);
            $dateTime2 = DateTime::createFromFormat('g:i A', $endTime);

            // Format the DateTime object to 24-hour format
            $cstartTime = $dateTime1->format('H:i:s');
            $cendTime = $dateTime2->format('H:i:s');

            if($cstartTime >= $cendTime){
                $status = FALSE;
                $msg='Start time cannot more than or equal to End time';
            } else{
                $this->dbMain->add_booking('booking', $post);
                $status = TRUE;
                $msg='Booking Successful!';
            }
        }
        $respond=array(
            'status'=>$status,
            'msg'=>$msg,
        );
        echo json_encode($respond);
    }
}