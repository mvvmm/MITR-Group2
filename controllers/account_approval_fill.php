<?php
require_once 'db_connector.php';
$conn = dbConnect();
$stmt = $conn->prepare('SELECT * FROM users WHERE approved = 0');
$stmt->execute();
$count = 1;
while($row = $stmt->fetch()){
  echo "<tr>";
  echo   "<th scope='row'>" . $count . "</th>";
  echo   "<td>" . $row['firstname'] . "</td>";
  echo   "<td>" . $row['lastname'] . "</td>";
  echo   "<td>" . $row['phone'] . "</td>";
  echo   "<td>" . $row['email'] . "</td>";
  echo   "<td><button type='submit' value='".$row['email']."' name='approve' class='btn btn-success btn-sm m-1'>Approve</button><button type='submit' value='".$row['email']."' name='deny' class='btn btn-danger btn-sm m-1 deny_account'>Deny</button></td>";
  echo "</tr>";
  $count++;
}
?>
