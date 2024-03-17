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
    // Load the database library
    $this->load->database();

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

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the data array
    $data = array(
        'name' => $name,
        'email' => $email,
        'password' => $hashed_password,
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
        $this->load->view('registration_complete');
    }
    

    
}
