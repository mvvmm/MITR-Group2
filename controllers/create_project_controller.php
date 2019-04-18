<?php
include_once "db_connector.php";
if(isset($_POST['address']) && $_POST['borough'] && $_POST['startDate'] && $_POST['endDate']) {
    $address = $_POST['address'];
    $borough = $_POST['borough'];
    $startDate = $_POST['startDate']." 00:00:00";
    $endDate = $_POST['endDate']." 00:00:00";
    $startDateTime = DateTime::createFromFormat('m/d/Y g:i:s', $startDate);
    $endDateTime = DateTime::createFromFormat('m/d/Y g:i:s', $endDate);


    if ($startDateTime == false || $endDateTime == false){
      echo "<script type='text/javascript'>alert('One or both of the dates and times you entered isn't the correct format. Try again using the calendar dropdown.');
      window.location.replace(\" ../create_project.php \");
      </script>";
    }

    $startDateTime = $startDateTime->format('Y-m-d H:i:s');
    $endDateTime = $endDateTime->format('Y-m-d H:i:s');

    // Check to see if a project already exists with this address
    $conn = dbConnect();
    $stmt = $conn->prepare('SELECT * FROM projects where address=:address');
    $stmt->bindParam(':address',$address);
    $stmt->execute();
    $duplicateAddress = $stmt->fetch();
    if($duplicateAddress){
      echo "<script type='text/javascript'>alert('A project with this address already exists.');
      window.location.replace(\" ../create_project.php \");
      </script>";
      exit();
    }

    $stmt = $conn->prepare('INSERT INTO projects (address,borough,starttime,endtime,active)
      VALUES (:address, :borough, :starttime, :endtime,1)');
    $stmt->bindParam(':address',$address);
    $stmt->bindParam(':borough',$borough);
    $stmt->bindParam(':starttime',$startDateTime);
    $stmt->bindParam(':endtime',$endDateTime);
    $stmt->execute();
    echo "<script type='text/javascript'>alert('Project Created Successfully');
    window.location.replace(\" ../index.php \");
    </script>";
} else {
    die("ERROR");
}
?>
