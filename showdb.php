<?php

//connect to MySQL database
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "amazon";

$dbConnected = new mysqli($hostname, $username, $password, $dbName);

$dbSuccess = true;
if (!$dbConnected) {
  echo "MySQL connection FAILED<br /><br />";
  $dbSuccess = false;
}

//if connected to database
if ($dbSuccess){



  //select all data from the database
  $sql = "SELECT * FROM collection";
  $result = $dbConnected->query($sql);

  echo "<table id='db' border=1>
  <tr>
  <th>ASIN</th>
  <th>Title</th>
  <th>MPN</th>
  <th>Price</th>
  </tr>";

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
}

?>
