<?php

define('DB_SERVER','localhost');

define('DB_USERNAME','admin');
 define('DB_PASSWORD','password');


define('DB_NAME','gportal');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME,DB_PASSWORD,DB_NAME);

if($conn == false){
    die('Error: Cannot connect');
}

?>