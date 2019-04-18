<?php
include_once "db_connector.php";
if(isset($_POST['address']) && $_POST['borough'] && $_POST['startDateInput'] && $_POST['startTimeInput'] && $_POST['endDateInput'] && $_POST['endTimeInput']) {
    $address = $_POST['address'];
    $borough = $_POST['borough'];

    $startDate = $_POST['startDateInput'];
    $startTime = date("H:i:s", strtotime($_POST['startTimeInput']));
    $startDatetime = $startDate . " " . $startTime;

    $endDate = $_POST['endDateInput'];
    $endTime = date("H:i:s", strtotime($_POST['endTimeInput']));
    $endDatetime = $endDate . " " . $endTime;

    $active = 1;

    $conn = dbConnect();
    $stmt = $conn->prepare('INSERT INTO projects (address,borough,starttime,endtime,active)
      VALUES (:address, :borough, :starttime, :endtime,:active)');
    $stmt->bindParam(':address',$address);
    $stmt->bindParam(':borough',$borough);
    $stmt->bindParam(':starttime',$startDatetime);
    $stmt->bindParam(':endtime',$endDatetime);
    $stmt->bindParam(':active', $active);
    $stmt->execute();
} else {
    die("ERROR: You must put something for all inputs.");
}
?>
