<?php

//connect to MySQL database
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "amazon";

$dbConnected = mysql_connect($hostname, $username, $password);

$dbSuccess = true;
if (!$dbConnected) {
  echo "MySQL connection FAILED<br /><br />";
  $dbSuccess = false;
}

//if connected to database, create database and table if they do not exist
if ($dbSuccess){

  $create_db = "Create DATABASE IF NOT EXISTS ".$dbName;
  if (mysql_query($create_db)) {
    $create_table = "CREATE TABLE ".$dbName.".collection ( ";
    $create_table .= "ID INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY, ";
    $create_table .= "ASIN VARCHAR( 50 ) NOT NULL, ";
    $create_table .= "Title VARCHAR( 250 ) NOT NULL, ";
    $create_table .= "MPN VARCHAR( 50 ) NOT NULL, ";
    $create_table .= "Price VARCHAR( 10 ) NOT NULL";
    $create_table .= ") ";
    mysql_query($create_table);
  }
}

?>
