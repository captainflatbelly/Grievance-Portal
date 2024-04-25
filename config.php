<?php

define('DB_SERVER','localhost');
<<<<<<< HEAD
define('DB_USERNAME','admin');
define('DB_PASSWORD','password');
=======
define('DB_USERNAME','root');
define('DB_PASSWORD','12345678');
define('DB_NAME','gportal');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME,DB_PASSWORD,DB_NAME);

if($conn == false){
    die('Error: Cannot connect');
}

?>