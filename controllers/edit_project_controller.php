<?php
require_once "db_connector.php";
require_once "functions.php";
if(isset($_POST['pid'])){

  $conn = dbConnect();
  $pid = $_POST['pid'];
  $stmt = $conn->prepare('SELECT * FROM projects WHERE pid=:pid');
  $stmt->bindParam(':pid',$pid);
  $stmt->execute();
  $project = $stmt->fetch();

  //Check for duplicate address
  $stmt = $conn->prepare('SELECT COUNT(*) as count FROM projects WHERE address=:address');
  $stmt->bindParam(':address',$_POST['address']);
  $stmt->execute();
  $count = $stmt->fetch()['count'];
  echo $count;
  if ($project['address'] == $_POST['address']){
    $count -= 1;
  }
  if($count > 0){
    echo "<script type='text/javascript'>
              alert('A project with this address already exists.');
              window.location.replace(\" ../edit_project.php \");
          </script>";
    exit();
  }

  $stmt = $conn->prepare('UPDATE projects SET address=:address, borough=:borough, starttime=:starttime, endtime=:endtime WHERE pid=:pid');

  if(isset($_POST['address']) && $_POST['address'] != ''){
    $address = $_POST['address'];
  }else{
    $address = $project['address'];
  }

  if(isset($_POST['borough']) && $_POST['borough'] != ''){
    $borough = $_POST['borough'];
  }else{
    $borough = $project['borough'];
  }

  if(isset($_POST['startDate']) && $_POST['startDate'] != ''){
    $startDate = $_POST['startDate']." 00:00:00";
    $startDateTime = DateTime::createFromFormat('m/d/Y H:i:s', $startDate);
    $starttime = $startDateTime->format('Y-m-d H:i:s');
  }else{
    $starttime = $project['starttime'];
  }

  if(isset($_POST['endDate']) && $_POST['endDate'] != ''){
    $endDate = $_POST['endDate']." 00:00:00";
    $endDateTime = DateTime::createFromFormat('m/d/Y H:i:s', $endDate);
    $endtime = $endDateTime->format('Y-m-d H:i:s');
  }else{
    $endtime = $project['endtime'];
  }

  //bind the params to the query
  $stmt->bindParam(':address',$address);
  $stmt->bindParam(':borough',$borough);
  $stmt->bindParam(':starttime',$starttime);
  $stmt->bindParam(':endtime',$endtime);
  $stmt->bindParam(':pid',$pid);
  $stmt->execute();
  echo "<script>
  alert('Project Updated');
  window.location.replace(\" ../index.php \");
  </script>";
  exit();
}else{
  die("ERROR");
}
?>
