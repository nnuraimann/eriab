<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('name'))
        redirect('office');
    }

    public function index()
    {
        $this->load->view('main/login');
    }

    public function login_check()
    {
        $this->load->library('form_validation');
        
        //Validation for login form
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');
        
        if($this->form_validation->run())
        {
            $email      = $this->input->post('email');
            $password   = md5($this->input->post('password'));
            $this->load->model('Main_model');
            $validate   = $this->Main_model->login_user($email,$password);
            // echo "<pre>", print_r($validate), "</pre>";
            // exit;
            if($validate)
            {
                $this->session->set_userdata('id',$validate->id);	
                $this->session->set_userdata('name',$validate->name);
                redirect('office/dashboard');
            } else {
            $this->session->set_flashdata('error','Invalid login details.Please try again.');
            redirect('main');
            }
        } else{
            $this->load->view('main');	
        }
    }

    public function login_process() {
        $this->load->library('form_validation');
        $this->load->model('Main_model');
    
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors());
            redirect('main/login');
        }
    
        $email = $this->input->post('email');
        $password = $this->input->post('password');
    
        $stored_hashed_password = $this->Main_model->get_hashed_password($email);
    
        if (!$stored_hashed_password) {
            $this->session->set_flashdata('message', 'Invalid email or password.');
            redirect('main/login');
        }
    
        if (password_verify($password, $stored_hashed_password)) {
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('message', 'Invalid email or password.');
            redirect('main/login');
        }
    }

    public function register()
    {
        $this->load->view('main/register');
    }

    public function register_process(){
        $this->load->library('form_validation');
        $this->load->model('Main_model');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors());
            redirect('main/register');
        }

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if ($this->Main_model->check_email($email)) {
            $this->session->set_flashdata('message', 'Email has already been registered. Please choose another one.');
            redirect('main/register');
        }

        $hashed_password = md5($password);

        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => $hashed_password,
            'date' => date('Y-m-d H:i:s'),
            'rank' => 'User'
        );

        if ($this->Main_model->create_user($data)) {
            redirect('main/registration_complete');
        } else {
            $this->session->set_flashdata('message', 'Registration failed. Please try again later.');
            redirect('main/register');
        }
    }

    public function registration_complete() 
    {
        $this->load->view('main/registration_complete');
    }
    
}
