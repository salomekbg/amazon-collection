<?php

//connect to MySQL database
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$hostname = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbName = substr($url["path"], 1);

$dbConnected = new mysqli($hostname, $username, $password, $dbName);

//select all data from the database
$sql = "SELECT * FROM collection";
$result = $dbConnected->query($sql);

//send back a table
echo "<table style='width: 100%; padding-left: 5px;'>
<tr>
  <th style='padding: 5px;'>ASIN</th>
  <th style='padding: 5px;'>Title</th>
  <th style='padding: 5px;'>MPN</th>
</tr>";

//put data into the table
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td style='padding: 5px;'>" . $row['ASIN'] . "</td>";
      echo "<td style='padding: 5px;'>" . $row['Title'] . "</td>";
      echo "<td style='padding: 5px;'>" . $row['MPN'] . "</td>";
      echo "<td>" . $row['Price'] . "</td>";
      echo "</tr>";
  }
  echo "</table>";
}

?>
