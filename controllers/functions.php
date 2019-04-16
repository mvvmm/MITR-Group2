<?php
require_once 'db_connector.php';
function getPrivilege(){
    if(isset($_COOKIE['JAN-SESSION'])){
        $sessionID = $_COOKIE['JAN-SESSION'];
        $conn = dbConnect();
        //grab the UserID (RIN) from the Session Data
        $stmt = $conn->prepare("SELECT uid FROM sessions WHERE sessionID = :sessionID");
        $stmt->bindParam(':sessionID',$sessionID);
        $stmt->execute();
        $uid = $stmt->fetchColumn();

        //use RIN to get Perms (Type)
        $stmt = $conn->prepare("SELECT privilege FROM users WHERE uid = :uid");
        $stmt->bindParam(':uid',$uid);
        $stmt->execute();
        $privilege = $stmt->fetchColumn();

        //return value
        return $privilege;
    }else{
        return 404;
    }
}

function getUID(){
  if(isset($_COOKIE['JAN-SESSION'])){
      $sessionID = $_COOKIE['JAN-SESSION'];
      $conn = dbConnect();
      //grab the UserID (RIN) from the Session Data
      $stmt = $conn->prepare("SELECT uid FROM sessions WHERE sessionID = :sessionID");
      $stmt->bindParam(':sessionID',$sessionID);
      $stmt->execute();
      $uid = $stmt->fetchColumn();
      return $uid;
  }else{
      return 404;
  }
}

function getQueuedAccountsCount(){
  $conn = dbConnect();
  $stmt = $conn->prepare('SELECT COUNT(uid) AS count FROM users WHERE approved = 0');
  $stmt->execute();
  $count = $stmt->fetch()['count'];
  if($count == 0){
    return '';
  }else{
    return $count;
  }
}

function generateUsersActiveProjects(){
  $uid = getUID();
  $conn = dbConnect();
  $stmt = $conn->prepare('SELECT pid FROM relations WHERE uid = :uid');
  $stmt->bindParam(':uid', $uid);
  $stmt->execute();
  $pids = $stmt->fetchall();
  foreach($pids as $pid){
    $stmt = $conn->prepare('SELECT address FROM projects WHERE pid = :pid AND active = 1');
    $stmt->bindParam(':pid',$pid["pid"]);
    $stmt->execute();
    $address = $stmt->fetchColumn();
    if($address){
      $option = "<option value='" . $address . "'>" . $address . "</option>";
      echo $option;
    }
  }
}
?>
