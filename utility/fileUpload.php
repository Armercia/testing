<?php
function handleFileUpload($file)
{
    // Debug print of the file array


    $uploadDir = 'uploads/';
    $target_file = $uploadDir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Check file size
    if ($file["size"] > 500000) {
        loadView(
            'component/notification',
            [
                'message' => 'File is too big.',
                'type' => 'error'
            ]
        );
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = ["jpg", "png", "jpeg", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        loadView(
            'component/notification',
            [
                'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.',
                'type' => 'error'
            ]
        );
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return null; // Return null if there was an error
    }

    // If everything is ok, try to upload the file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        // Return the file path relative to the root directory
        return $target_file;
    } else {
        loadView(
            'component/notification',
            [
                'message' => 'There was an error uploading your file.',
                'type' => 'error'
            ]
        );
        return null;
    }
}