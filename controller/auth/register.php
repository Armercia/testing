<?php

require basePath('vendor/autoload.php');

use Respect\Validation\Validator as v;

function validateRegistrationData($data) {
    return v::notEmpty()->validate($data["username"]) &&
           v::notEmpty()->email()->validate($data["email"]) &&
           v::notEmpty()->validate($data["password"]) &&
           v::notEmpty()->validate($data["user_type"]);
}

function registerController() {
 
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        loadView('register');
        return;
    }

    $postData = $_POST;

    if (empty($postData["username"]) || empty($postData['password']) || empty($postData['user_type']) || empty($postData['email'])) {
        loadView('register');
        return;
    }

    if (!validateRegistrationData($postData)) {
        loadView('component/notification', ['message' => 'Invalid user credentials', 'type' => 'error']);
        loadView('register');
        return;
    }

    $username = $postData['username'];
    $email = $postData['email'];
    $user_type = $postData['user_type'];
    $password = $postData['password'];

    $alreadyExists = query('SELECT * FROM users WHERE username = :username AND email = :email', [
        'username' => $username,
        'email' => $email
    ]);

    // var_dump($alreadyExists );
    if ($alreadyExists['data']) {
        loadView('component/notification', ['message' => 'User data already exists', 'type' => 'error']);
        loadView('register');
        return;
    }

    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    query_create('INSERT INTO users (username, password, email, user_type) VALUES (:username, :password, :email, :user_type)', [
        'username' => $username,
        'email' => $email,
        'user_type' => $user_type,
        'password' => $hashPassword
    ]);

    $userData = query('SELECT * FROM users WHERE username = :username', [
        'username' => $username
    ]);

    if ($userData) {
        $_SESSION['user'] = $userData['data'];
        // var_dump($userData);
        header('Location: dashboard');
        return;
    }

    loadView('register');
}
?>
