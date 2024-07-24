<?php

require 'vendor/autoload.php';
require    __DIR__ .'/utility/index.php';
session_start();

require(basePath('db/connection.php'));
require(basePath('controller/index.php'));
require(basePath('router/index.php'));





// query_create('INSERT INTO elections (title, description) VALUES (:title, :description)', [
//     'description' => 'Presidential elections 2024',
//     'title' => 'elections for the next President.'
// ]);