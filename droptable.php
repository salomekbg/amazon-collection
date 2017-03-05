<?php

//connect to MySQL database
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$hostname = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbName = substr($url["path"], 1);

$dbConnected = new mysqli($hostname, $username, $password, $dbName);

//drop database if successfully connected to database
$drop_table = "DROP TABLE collection";
$dbConnected->query($drop_table);

?>
