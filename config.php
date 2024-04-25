<?php

define('DB_SERVER','localhost');
define('DB_USERNAME','root');
                                                                                                                                                                                                                                                 define('DB_PASSWORD','2404');
define('DB_NAME','gportal');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME,DB_PASSWORD,DB_NAME);

if($conn == false){
    die('Error: Cannot connect');
}

?>