<?php

//Remote database
$Database_host 	= "localhost";
$Database_name 	= "id12203368_ali_db";
$Database_user 	= "id12203368_root";
$Database_pass 	= "K18nT8r8";

if ($_SERVER['SERVER_NAME'] == 'localhost'){
    ////Local database
    $Database_host = "localhost";
    $Database_name = "simpleblogger";
    $Database_user = "root";
    $Database_pass = "";
}

$charset = "utf8";

$Database_con = mysqli_connect($Database_host, $Database_user, $Database_pass);

if (!$Database_con) {
    die("Connection failed" . mysqli_connect_error());
}

//echo "Connection to the database was successfull!";
mysqli_select_db($Database_con, $Database_name);
mysqli_set_charset($Database_con, $charset);
