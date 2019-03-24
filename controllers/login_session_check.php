<?php
// Redirects users trying to login back to index if they already have a session.
if(isset($_COOKIE['JAN-SESSION'])){
  require_once('db_connector.php');
  $conn = dbConnect();
  $stmt = $conn->prepare("SELECT * FROM sessions WHERE sessionID = :sessID");
  $stmt->bindParam(":sessID", $_COOKIE['JAN-SESSION']);
  $stmt->execute();
  $session = $stmt->fetch();
  if($session){
    header("Location: ./index.php");
  }else{
    setcookie("JAN-SESSION",'', time() - 36000,'/');
  }
}
?>
