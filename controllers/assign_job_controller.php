<?php
include_once "db_connector.php";
if(isset($_POST['employee']) && $_POST['project'] && $_POST['dateTime']) {

    $uid = $_POST['employee'];
    $pid = $_POST['project'];
    $date = DateTime::createFromFormat('m/d/Y g:i A', $_POST['dateTime']);

    // Make sure user entered an actually date in the format we want.
    if ($date == false){
      echo "<script type='text/javascript'>alert('The date and time you entered isn't the correct format. Try again using the calendar dropdown.');
      window.location.replace(\" ../clock_IO.php \");
      </script>";
    }

    $date = $date->format('Y-m-d H:i:s');
    $conn = dbConnect();

    //check to make sure not duplicate data
    $stmt = $conn->prepare('SELECT * FROM relations WHERE uid=:uid AND pid=:pid AND date=:date');
    $stmt->bindParam(':uid',$uid);
    $stmt->bindParam(':pid',$pid);
    $stmt->bindParam(':date',$date);
    $stmt->execute();
    $duplicateJob = $stmt->fetch();
    if($duplicateJob){
      echo "<script type='text/javascript'>alert('A job with this user, project, and date already exists.');
      window.location.replace(\" ../assign_job.php \");
      </script>";
      exit();
    }


    $stmt = $conn->prepare('INSERT INTO relations (uid,pid,date)
      VALUES (:uid, :pid, :date)');
    $stmt->bindParam(':uid',$uid);
    $stmt->bindParam(':pid',$pid);
    $stmt->bindParam(':date',$date);
    $stmt->execute();
    echo "<script type='text/javascript'>alert('Job assigned Successfully');
    window.location.replace(\" ../assign_job.php \");
    </script>";
    exit();

} else {
    die("ERROR");
}

?>
