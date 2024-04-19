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

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->sess_destroy();
        return redirect('main');
    }
}