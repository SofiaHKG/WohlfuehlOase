<?php
$host = "localhost";
$user = "bifuser1";
$password = "Biro1999";
$database = "bif1webtechdb";

$db_obj = new mysqli($host, $user, $password, $database);
    if ($db_obj->connect_error) {
      echo "Connection Error: " . $db_obj->connect_error;
     exit();
    }
?>