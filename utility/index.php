<?php

require 'fileUpload.php';

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function basePath($path)
{
    return dirname(__DIR__) . '/' . $path;
}

function loadView($name, $data = [])
{
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>

    </head>
    <body >
';
    $viewPath = basePath("views/{$name}.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        require basePath("views/error.php");
    }

    echo '
    </body>
    </html>';
}

function loadComponent($name, $data = [])
{

    $viewPath = basePath("views/component/{$name}.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo 'Component' . $name . ' does not exist';
    }
}

function _print($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

function format_date($data_string, $format = 'Y-m-d')
{

    $timestamp = strtotime($data_string);

    return date($format, $timestamp);
}

function limitString($string, $maxCount)
{

    if (strlen($string) > $maxCount) {
        $shortenedString = substr($string, 0, $maxCount) . "...";
    } else {
        $shortenedString = $string;
    }
    return $shortenedString;
}


?>



<script>
    console.log('log the use data')
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>