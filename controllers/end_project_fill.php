<?php
require_once 'db_connector.php';
$conn = dbConnect();
$stmt = $conn->prepare('SELECT * FROM projects WHERE active = 1');
$stmt->execute();
$count = 1;
while($row = $stmt->fetch()){
  $starttimein = strtotime($row['starttime']);
  $starttimeout = date('F n, Y',$starttimein);
  echo "<tr class='text-center'>";
  echo   "<th scope='row'>" . $count . "</th>";
  echo   "<td>" . $row['address'] . "</td>";
  echo   "<td>" . $row['borough'] . "</td>";
  echo   "<td>" . $starttimeout . "</td>";
  echo   "<td><button type='submit' value='".$row['pid']."' name='end' class='btn btn-danger btn'>End Project</button></td>";
  echo "</tr>";
  $count++;
}
?>
