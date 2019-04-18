<?php

include_once "db_connector.php";
if(isset($_POST['employee']) && $_POST['project'] && $_POST['dateInput'] && $_POST['timeInput']) {

    $uid = $_POST['employee'];
    $pid = $_POST['project'];
    $date = $_POST['dateInput'];
    $time = date("H:i", strtotime($_POST['timeInput']));
    $datetime = $date . " " . $time . ":00";
    echo($datetime);

    $conn = dbConnect();
    $stmt = $conn->prepare('INSERT INTO relations (uid,pid,date)
      VALUES (:uid, :pid, :date)');
    $stmt->bindParam(':uid',$uid);
    $stmt->bindParam(':pid',$pid);
    $stmt->bindParam(':date',$datetime);
    $stmt->execute();

} else {
    die("ERROR: You must put something for all inputs.");
}

?>
