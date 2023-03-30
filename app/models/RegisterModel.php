<?php
class User
{
    public function createUser($name, $email, $password)
    {
        // Insert user data into database
    }

    public function getUserByEmail($email)
    {
        // Retrieve user data from database by email
    }
}

// User controller
class UserController
{
    public function showRegistrationForm()
    {
        // Render registration form view
    }

    public function registerUser()
    {
        // Get user data from request
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate user input

        // Create user using model
        $user = new User();
        $user->createUser($name, $email, $password);

        // Redirect user to login page
        header("Location: /login");
    }
}

// Define routes
$router->get('/register', 'UserController@showRegistrationForm');
$router->post('/register', 'UserController@registerUser');
?>

// Registration form view
<form action="/register" method="post">
    <label>Name:</label>
    <input type="text" name="name">
    <label>Email:</label>
    <input type="email" name="email">
    <label>Password:</label>
    <input type="password" name="password">
    <button type="submit">Register</button>
</form>