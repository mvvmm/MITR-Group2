<?php
include_once "db_connector.php";
if(isset($_POST['address']) && $_POST['borough'] && $_POST['startDate'] && $_POST['endDate']) {
    $address = $_POST['address'];
    $borough = $_POST['borough'];

    $startDate = DateTime::createFromFormat('m/d/Y', $_POST['startDate']."00:00:00");
    $endDate = DateTime::createFromFormat('m/d/Y', $_POST['endDate']."00:00:00");

    if ($startDate == false || $endDate == false){
      echo "<script type='text/javascript'>alert('One or both of the dates and times you entered isn't the correct format. Try again using the calendar dropdown.');
      window.location.replace(\" ../create_project.php \");
      </script>";
    }

    // Check to see if a project already exists with this address
    $conn = dbConnect();
    $stmt = $conn->prepare('SELECT * FROM projects where address=:address');
    $stmt->bindParam(':address',$address);
    $stmt->execute();
    $stmt->fetchAll();
    if($stmt){
      echo "<script type='text/javascript'>alert('A project with this address already exists.');
      window.location.replace(\" ../create_project.php \");
      </script>";
    }

    $stmt = $conn->prepare('INSERT INTO projects (address,borough,starttime,endtime,active)
      VALUES (:address, :borough, :starttime, :endtime,1)');
    $stmt->bindParam(':address',$address);
    $stmt->bindParam(':borough',$borough);
    $stmt->bindParam(':starttime',$startDate);
    $stmt->bindParam(':endtime',$endDate);
    $stmt->execute();
} else {
    die("ERROR");
}
?>
