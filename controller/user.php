<?php

require basePath('vendor/autoload.php');
use Respect\Validation\Validator as v;

function updateUser()
{
    basePath("utility/fileUpload.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $img_url = isset($_FILES['file']) ? handleFileUpload($_FILES['file']) : $_SESSION['user']['user_img_url'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $bio = $_POST['bio'];
        $gender = "male";
        $user_id = $_SESSION['user']['user_id'];

        if (v::notEmpty()->validate($username) && v::notEmpty()->validate($email)) {
            try {
                query_create('UPDATE users SET
                    username = :username,
                    email = :email,
                    bio = :bio,
                    user_img_url = :user_img_url,
                    gender = :gender
                    WHERE user_id = :user_id', [
                    ':username' => $username,
                    ':user_img_url' => $img_url,
                    ':email' => $email,
                    ':bio' => $bio,
                    ':gender' => $gender,
                    ':user_id' => $user_id
                ]);

                $user_updated = query_create('SELECT * FROM users WHERE user_id = :user_id', [':user_id' => $user_id]);
                $_SESSION['user'] = $user_updated[0];
                loadView('component/notification', ['message' => 'Data updated successfully', 'type' => 'success']);
            } catch (Exception $e) {
                loadView('component/notification', ['message' => 'User data already exists', 'type' => 'error']);
            }
        } else {
            loadView('component/notification', ['message' => 'Please input valid data', 'type' => 'error']);
        }
    }


}

function deleteUser($id){

    if (v::notEmpty()->validate($id) ) {
        try {
            query_create('DELETE FROM votes WHERE voter_id = :voter_id', [
                ':voter_id' => $id
            ]);

            query_create('DELETE FROM election_candidates WHERE user_id = :user_id', [
                ':user_id' => $id
            ]);
             query_create('DELETE FROM users WHERE user_id = :user_id', [
                ':user_id' => $id
            ]);
            loadView('component/notification', ['message' => 'User deleted successfully', 'type' => 'success']);
        } catch (Exception $e) {
            loadView('component/notification', ['message' => 'User data already exists', 'type' => 'error']);
        }
    } else {
        loadView('component/notification', ['message' => 'Please input valid data', 'type' => 'error']);
    }
}


function deleteElection($id){

    if (v::notEmpty()->validate($id) ) {
        try {

            query_create('DELETE FROM votes WHERE election_id = :election_id', [
                ':election_id' => $id
            ]);
           
            query_create('DELETE FROM election_candidates WHERE election_id = :election_id', [
                'election_id' => $id
            ]);
             query_create('DELETE FROM elections WHERE election_id = :election_id', [
                'election_id' => $id
            ]);


            loadView('component/notification', ['message' => 'Election deleted successfully', 'type' => 'success']);
        } catch (Exception $e) {
            loadView('component/notification', ['message' => 'Election data already exists', 'type' => 'error']);
        }
    } else {
        loadView('component/notification', ['message' => 'Please input valid data', 'type' => 'error']);
    }
}
