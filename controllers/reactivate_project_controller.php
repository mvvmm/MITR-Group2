<?php
require_once "db_connector.php";
$conn = dbConnect();

if (isset($_POST['reactivate'])){
  $pid = $_POST['reactivate'];
  date_default_timezone_set('America/New_York');
  //End time is now a month from todays date
  $endtime = date('Y-m-d', strtotime("+1 month",time()))." 00:00:00";
  echo $endtime;
  $stmt = $conn->prepare('UPDATE projects SET active = 1, endtime=:endtime WHERE pid = :pid');
  $stmt->bindParam(":endtime",$endtime);
  $stmt->bindParam(":pid",$pid);
  $stmt->execute();
  header("Location: ../reactivate_project.php");
  exit();
}else{
  die("Error");
}

?>
