<?php

//get keywords from form
$info = $_POST['data'];

//connect to MySQL database
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$hostname = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbName = substr($url["path"], 1);

$dbConnected = new mysqli($hostname, $username, $password, $dbName);

//add data to the database
$add_data = 'INSERT INTO '.$dbName.'.collection ( ';
$add_data .= 'ASIN, ';
$add_data .= 'Title, ';
$add_data .= 'MPN, ';
$add_data .= 'Price ';
$add_data .= ') ';

$add_data .= 'VALUES ( ';
$add_data .= ""."'".$info['asin']."', ";
$add_data .= ""."'".htmlspecialchars($info['title'], ENT_QUOTES)."', ";
$add_data .= ""."'".$info['mpn']."', ";
$add_data .= ""."'".$info['price']."' ";
$add_data .= ') ';
$dbConnected->query($add_data);

?>
