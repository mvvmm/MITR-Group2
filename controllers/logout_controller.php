<?php
if(isset($_COOKIE['JAN-SESSION'])){
    require_once('db_connector.php');
    $conn = dbConnect();
    $stmt = $conn->prepare("DELETE FROM `sessions` WHERE `sessionID`=:sessID");
    $stmt->bindParam(":sessID", $_COOKIE['JAN-SESSION']);
    $stmt->execute();
    setcookie("JAN-SESSION",'', time() - 36000,'/');
}
header("Location: ../index.php");
?>
