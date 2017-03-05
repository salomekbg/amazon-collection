<?php

//get keywords from form
$info = $_POST['data'];

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

//if connected to database
if ($dbSuccess){

  //select database
  $dbSelected = mysql_select_db($dbName, $dbConnected);

  //add data to the database
  $add_data = 'INSERT INTO '.$dbName.'.collection ( ';
  $add_data .= 'ASIN, ';
  $add_data .= 'Title, ';
  $add_data .= 'MPN, ';
  $add_data .= 'Price ';
  $add_data .= ') ';

  $add_data .= 'VALUES ( ';
  $add_data .= ""."'".$info['asin']."', ";
  $add_data .= ""."'".$info['title']."', ";
  $add_data .= ""."'".$info['mpn']."', ";
  $add_data .= ""."'".$info['price']."' ";
  $add_data .= ') ';
  mysql_query($add_data);
}

?>
