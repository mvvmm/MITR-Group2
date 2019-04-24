<?php
require_once 'db_connector.php';
$conn = dbConnect();
$stmt = $conn->prepare('SELECT * FROM projects WHERE active = 0');
$stmt->execute();
$count = 1;
while($row = $stmt->fetch()){
  $endtimein = strtotime($row['endtime']);
  $endtimeout = date('F n, Y',$endtimein);
  echo "<tr class='text-center'>";
  echo   "<th scope='row'>" . $count . "</th>";
  echo   "<td>" . $row['address'] . "</td>";
  echo   "<td>" . $row['borough'] . "</td>";
  echo   "<td>" . $endtimeout . "</td>";
  echo   "<td><button type='submit' value='".$row['pid']."' name='reactivate' class='btn btn-success btn'>Reactivate</button></td>";
  echo "</tr>";
  $count++;
}
?>
