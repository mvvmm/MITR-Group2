<?php
require_once "db_connector.php";
$conn = dbConnect();

if (isset($_POST['end'])){
  $pid = $_POST['end'];
  date_default_timezone_set('America/New_York');
  $endtime = date('Y-m-d h:i:s', time());
  $stmt = $conn->prepare('UPDATE projects SET active = 0 AND endtime = :endtime WHERE pid = :pid');
  $stmt->bindParam(":endtime",$endtime);
  $stmt->bindParam(":pid",$pid);
  $stmt->execute();
  header("Location: ../end_project.php");
  exit();
}else{
  die("Error");
}

?>
