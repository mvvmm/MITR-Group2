<?php
require_once "db_connector.php";
$conn = dbConnect();

if (isset($_POST['approve'])){
  $email = $_POST['approve'];
  $stmt = $conn->prepare('UPDATE users SET approved = 1 WHERE email = :email');
  $stmt->bindParam(":email",$email);
  $stmt->execute();
  header("Location: ../account_approval.php");
  exit();
}

if (isset($_POST['deny'])){
  $email = $_POST['deny'];
  $stmt = $conn->prepare('DELETE FROM users WHERE email = :email');
  $stmt->bindParam(":email",$email);
  $stmt->execute();
  header("Location: ../account_approval.php");
  exit();
}
?>
