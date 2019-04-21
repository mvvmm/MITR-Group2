<?php
require_once "db_connector.php";
require_once "functions.php";
if(isset($_POST['project'])){
  $conn = dbConnect();
  $pid = $_POST['project'];
  $stmt = $conn->prepare('SELECT * FROM projects WHERE pid=:pid');
  $stmt->bindParam(':pid',$pid);
  $stmt->execute();
  $project = $stmt->fetch();
  $starttimein = strtotime($project['starttime']);
  $endtimein = strtotime($project['endtime']);
  $starttimeout = date('m/d/Y',$starttimein);
  $endtimeout = date('m/d/Y',$starttimein);
  echo $project['pid']."%^%";
  echo $project['address']."%^%";
  echo $project['borough']."%^%";
  echo $starttimeout."%^%";
  echo $endtimeout;
}
else{
    echo "Did not select a project.";
}
?>
