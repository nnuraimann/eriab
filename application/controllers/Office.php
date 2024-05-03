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
        $data['user'] = $this->session->userdata();
        $this->load->view('office/dashboard', $data);
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
        $this->load->view('template/office/main', $data);
    }

    public function user_create($data=false)
    {
        $data['user'] = $this->session->userdata();
        $data['content'] = 'office/room_setup/create';
        $this->load->view('template/office/main', $data);
    }

    public function user_store($data=false)
    {
        $post=$this->input->post();
        // echo "<pre>", print_r($post), "</pre>";
        $this->dbMain->add_user('users', $post);
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
}