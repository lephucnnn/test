<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "api";

$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn,"utf8");