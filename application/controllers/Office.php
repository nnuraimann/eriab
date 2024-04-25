<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Office extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('name'))
        redirect('main');
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