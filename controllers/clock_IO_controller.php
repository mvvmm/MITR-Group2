<?php
require_once "db_connector.php";
require_once "functions.php";
if (isset($_POST['dateTime']) && isset($_POST['projectAddress'])){

  $date = DateTime::createFromFormat('m/d/Y g:i A', $_POST['dateTime']);

  // Make sure user entered an actually date in the format we want.
  if ($date == false){
    echo "<script type='text/javascript'>alert('The date and time you entered isn't the correct format. Try again using the calendar dropdown.');
    window.location.replace(\" ../clock_IO.php \");
    </script>";
  }

  // Set up some necessary variables
  $date = $date->format('Y-m-d H:i:s');
  $IO = $_POST['IO'];
  $uid = getUID();
  $projectAddress = $_POST['projectAddress'];
  $inrange = $_POST['inrange'];

  $conn = dbConnect();
  $stmt = $conn->prepare('SELECT pid FROM projects WHERE address = :address ');
  $stmt->bindParam(':address',$projectAddress);
  $stmt->execute();
  $pid = $stmt->fetchColumn();

  $stmt = $conn->prepare('SELECT * FROM timesheet WHERE pid=:pid AND uid=:uid');
  $stmt->bindParam(':uid', $uid);
  $stmt->bindParam(':pid', $pid);
  $stmt->execute();
  $times = $stmt->fetchAll();
  $currentlyClockedIn = false;
  foreach($times as $time){
    if (is_null($time['endtime'])){
      $currentlyClockedIn = true;
    }
  }

  // If user is trying to clock in
  if ($IO == 'in'){
    //Cant clock in if already clocked in.
    if ($currentlyClockedIn){
      echo "<script type='text/javascript'>alert('You are already clocked in. Clock out from a previous date to clock in again.');
      window.location.replace(\" ../clock_IO.php \");
      </script>";
    }else{
      $stmt = $conn->prepare('INSERT INTO timesheet (uid,pid,starttime,inlocation) VALUES (:uid,:pid,:starttime,:inlocation)');
      $stmt->bindParam(':uid', $uid);
      $stmt->bindParam(':pid', $pid);
      $stmt->bindParam(':starttime', $date);
      $stmt->bindParam(':inlocation', $inrange);
      $stmt->execute();
      echo "<script>
      alert('Clocked in successfully');
      window.location.replace(\" ../index.php \");
      </script>";
    }
  }

  // If user is trying to clock out
  else if ($IO == 'out'){
    // Can't clock out if not clocked in.
    if (!$currentlyClockedIn){
      echo "<script type='text/javascript'>alert('You are not clocked in. You need to be clocked in before you can clock out.');
      window.location.replace(\" ../clock_IO.php \");
      </script>";
    }else{
      $stmt = $conn->prepare('UPDATE timesheet SET endtime=:endtime WHERE uid=:uid AND pid=:pid AND endtime IS NULL');
      $stmt->bindParam(':endtime', $date);
      $stmt->bindParam(':uid', $uid);
      $stmt->bindParam(':pid', $pid);
      $stmt->execute();
      echo "<script>
      alert('Clocked out successfully');
      window.location.replace(\" ../index.php \");
      </script>";
    }
  }
}
?>
