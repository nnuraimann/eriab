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
                redirect('main/dashboard');
            } else {
                echo "User does not exist or password is incorrect";
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
        // Load the database library
        $this->load->database();
        $this->load->model('Main_model');
    
        // Get user input values
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
    
        // Validate user input
        if (empty($name) || empty($email) || empty($password)) {
            // User input is invalid
            $this->session->set_flashdata('message', 'Please fill in all required fields.');
            redirect('main/register');
        }
    
        // Check if user email already exists
        // $DB = new PDO("mysql:host=localhost;dbname=ranks_db","root","");
        // $query = $DB->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        // $query->execute([$email]);
        // $result = $query->fetchColumn();
        // $DB = null;
    
        // if ($result > 0) {
        //     // Email already exists
        //     $this->session->set_flashdata('message', 'Email has already been registered. Please choose another one.');
        //     redirect('main/register');
        // }

        $validate = $this->Main_model->check_email($email);
        if($validate == true)
        {
            echo "Email already Exist";
        }else{
            echo "successfully";
        }
        exit;
        echo "here " . $validate;exit;
    
        // Prepare the data array
        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => $password, // Store password as entered by the user
            'date' => date('Y-m-d H:i:s'),
            'rank' => 'User'
        );
    
        // Insert the data into the database
        if ($this->db->insert('users', $data)) {
            // Registration successful
            redirect('registration_complete'); // Redirect to registration_complete.php
        } else {
            // Registration failed
            $this->session->set_flashdata('message', 'Registration failed. Please try again later.');
            redirect('main/register');
        }
    }
    

    public function dashboard()
    {
    
        $this->load->view('main/dashboard');
    }

    public function registration_complete() {
        $this->load->view('main/registration_complete');
    }

    public function logout(){
        session_destroy();
        redirect('main');
    }

    public function login_complete(){
        $this->load->view('main/dashboard');
    }
    
}
