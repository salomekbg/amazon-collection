<?php

//connect to MySQL database
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$hostname = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbName = substr($url["path"], 1);

$dbConnected = new mysqli($hostname, $username, $password, $dbName);

//create table
$create_table = "CREATE TABLE ".$dbName.".collection ( ";
$create_table .= "ID INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY, ";
$create_table .= "ASIN VARCHAR( 50 ) NOT NULL, ";
$create_table .= "Title VARCHAR( 1000 ) NOT NULL, ";
$create_table .= "MPN VARCHAR( 50 ) NOT NULL, ";
$create_table .= "Price VARCHAR( 100 ) NOT NULL";
$create_table .= ") ";
$dbConnected->query($create_table);

?>
