<?php

class RegisterController
{
    // Function to show registration form
    public function showRegistrationForm()
    {
        // Load view file to display registration form
        include 'views/register.php';
    }

    // Function to handle registration form submission
    public function registerUser()
    {
        // Validate user input
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Perform server-side validation of user input (e.g. check if email is valid, password meets requirements)
        // If validation fails, display an error message and redirect to the registration form

        // Create user in the database
        $userModel = new User();
        $result = $userModel->createUser($name, $email, $password);

        if ($result) {
            // Registration successful, redirect to login page
            header('Location: /login');
            exit;
        } else {
            // Registration failed, display an error message and redirect to the registration form
            $errorMessage = "Error: Could not register user.";
            include 'views/register.php';
        }
    }
}
