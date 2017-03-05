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
echo "<table id='db' border=1>
<tr>
<th>ASIN</th>
<th>Title</th>
<th>MPN</th>
<th>Price</th>
</tr>";

//put data into the table
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['ASIN'] . "</td>";
      echo "<td>" . $row['Title'] . "</td>";
      echo "<td>" . $row['MPN'] . "</td>";
      echo "<td>" . $row['Price'] . "</td>";
      echo "</tr>";
  }
  echo "</table>";
}

?>
