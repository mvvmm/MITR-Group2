<?php
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
?>