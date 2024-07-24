<?php 

use Bramus\Router\Router;

$router = new Router();

include(basePath('router/middleware.php'));

$router->before('GET|POST', '/', function() {
//   if (!isset($_SESSION['user'])) {
//       header('location: /home');
//       exit();
//   }
// loadView('home');
});

$router->before('GET|POST', '/home', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
  });
$router->get('/index', function( ){
    if (isset($_SESSION['user'])) {
        header('location: /home');
        exit();
    }
    loadView('index');
});

$router->get('/', function( ){
    loadView('home');
});


$router->match('GET|POST', '/login', function( ){
    loginController();
});

$router->match('GET|POST', '/register', function( ){
    registerController();
});


$router->get('/dashboard', function( ){
    loadView('dashboardLayout', ['component' => 'dashboard']);
});

$router->match('GET|POST', '/register-elections', function( ){
    loadView('dashboardLayout', ['component' => 'registerElection']);
});


$router->match('GET|POST', '/profile', function( ){
    // updateUser();
    loadView('dashboardLayout', ['component' => 'profile']);
});

$router->match('GET|POST', '/cast_vote', function( ){
    voteController();
    loadView('dashboardLayout', ['component' => 'dashboard']);
});



$router->match('GET|POST', '/create-elections', function( ){

    loadView('dashboardLayout', ['component' => 'createelections']);
});

$router->match('GET|POST', '/admin', function( ){
    createelections();
    loadView('dashboardLayout', ['component' => 'admin']);
});



$router->get('/user/delete/(\w+)', function($id ){
    $id = htmlentities($id);
    // usersDelete($id);
});

$router->get('/home/(\w+)', function($id){
    // electionsDetails($id);
});


$router->get('/logout', function( ){
    session_destroy();
    header("Location: login");
});



$router->get('/about', function( ){
   loadView('about');
});

$router->get('/contact_us', function( ){
    loadView('contact_us');
 });




$router->set404(function() {
    loadView('error');
    // echo ' Page not found';
});


$router->run();
