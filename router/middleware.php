<?php 

function isUserLogin() {
    if (!isset($_SESSION['user'])) {
        http_response_code(401);

        loadView('component/notification', [
            'message' => 'User does not have access to this resource.', 
            'type' => 'error'
        ]);

        header('location: /login');
        echo '401 - Unauthorized';
        exit();
    }
}


?>