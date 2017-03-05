<?php

//connect to MySQL database
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "amazon";

$dbConnected = mysql_connect($hostname, $username, $password);
$dbSelected = mysql_select_db($dbName, $dbConnected);

$dbSuccess = true;
if ($dbConnected) {
  if (!$dbSelected) {
    echo "DB connection FAILED<br /><br />";
    $dbSuccess = false;
  }
} else {
  echo "MySQL connection FAILED<br /><br />";
  $dbSuccess = false;
}

//drop database if successfully connected to database
if ($dbSuccess){
  $drop_db = "DROP DATABASE IF EXISTS ".$dbName;
  mysql_query($drop_db);
}

?>
