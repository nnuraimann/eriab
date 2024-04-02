<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Office extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('email'))
        redirect('main');
    }

    public function index()
    {
        $this->load->view('office/dashboard');
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->sess_destroy();
        return redirect('main');
    }
}