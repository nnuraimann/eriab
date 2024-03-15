<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index()
    {
        // Load the login view
        $this->load->view('main/login');
    }

    public function login_check()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email']; 
            $password = $_POST['password']; 

            $DB = new PDO("mysql:host=localhost;dbname=ranks_db","root","");

            $query = $DB->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo "User exists";
            } else {
                echo "User does not exist";
            }

            $DB = null;
        }
    }

    public function register()
    {
        
        $this->load->view('main/register');
    }

    public function register_process()
{
    print_r($_POST);exit();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            
            $this->load->view('main/register');
        } else {
            
            $data = array(
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'registration_date' => date('Y-m-d H:i:s') 
            );
            $inserted = $this->db->insert('users', $data);

            if ($inserted) {
                
                $data['message'] = "Registration successful!";
                $this->load->view('main/register', $data);
            } else {
                
                $data['message'] = "Registration failed!";
                $this->load->view('main/register', $data);
            }
        }
    }
}
}