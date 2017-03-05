<?php

//connect to MySQL database
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$hostname = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbName = substr($url["path"], 1);

$dbConnected = new mysqli($hostname, $username, $password, $dbName);
// $dbSelected = mysql_select_db($dbName, $dbConnected);

// $dbSuccess = true;
// if ($dbConnected) {
//   if (!$dbSelected) {
//     echo "DB connection FAILED<br /><br />";
//     $dbSuccess = false;
//   }
// } else {
//   echo "MySQL connection FAILED<br /><br />";
//   $dbSuccess = false;
// }

//drop database if successfully connected to database
// if ($dbSuccess){
  $drop_db = "DROP TABLE collection";
  $dbConnected->query($drop_db);
// }

?>
