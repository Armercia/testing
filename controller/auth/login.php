<?php

require basePath('vendor/autoload.php');

use Respect\Validation\Validator as v;

function validateLoginData($data)
{
  return v::notEmpty()->validate($data['email']) && v::notEmpty()->validate($data['password']);
}

function authenticateUser($email, $password)
{
  $userResult = query('SELECT * FROM users WHERE email = :email', ['email' => $email]);
  if ($userResult['data']) {
    # code...
    $dbPassword = $userResult['data'][0]["password"];
    $dbUser = $userResult['data'][0];

    if (password_verify($password, $dbPassword)) {
      return $dbUser;
    }
  }

  return false;
}


function loginController()
{
  if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    loadView('login');
    return;
  }

  $email = $_POST['email'];
  $password = $_POST['password'];


  if (empty($email) || empty($password)) {
    loadView('component/notification', ['message' => 'Email and password are required.', 'type' => 'error']);
    loadView('login');
    return;
  }

  if (!validateLoginData(['email' => $email, 'password' => $password])) {
    loadView('component/notification', ['message' => 'Invalid user email ', 'type' => 'error']);
    loadView('login');
    return;
  }

  $userAuth = authenticateUser($email, $password);


  if ($userAuth) {
    $_SESSION["user"] = $userAuth;
    header("Location: dashboard");
  } else {
    loadView('component/notification', ['message' => 'Invalid user credentials', 'type' => 'error']);
    loadView('login');
  }
}
