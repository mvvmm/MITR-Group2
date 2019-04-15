<?php
require_once "db_connector.php";
$conn = dbConnect();
if(isset($_POST['email']) && isset($_POST['password'])){
  $email = $_POST['email'];
  $user_pass = $_POST['password'];
  $stmt = $conn->prepare('SELECT * FROM users WHERE email=:email');
  $stmt->bindParam(':email',$email);
  $stmt->execute();
  $user = $stmt->fetch();
  if(!$user){
    echo "<script>
      alert('Your email is incorrect!');
      window.location.replace(\" ../login.php \");
    </script>";
    exit();
  }else if($user['approved'] != 1){
    echo "<script>
      alert('Your account activation is pending approval.');
      window.location.replace(\" ../index.php \");
    </script>";
  }else{
    if(password_verify($user_pass,$user['password'])){
      $stmt = $conn->prepare('INSERT INTO sessions (sessionID, uid,expiration)
      VALUES (:sessionID,:uid,:expiration)');
      $sessionID = uniqid('',true);
      $stmt->bindParam(':sessionID',$sessionID);
      $stmt->bindParam(':uid',$user['uid']);
      $expiration_date = date("Y-m-d H:i:s",time() + (24*60*60));
      $stmt->bindParam(':expiration',$expiration_date);
      $stmt->execute();
      setcookie("JAN-SESSION",$sessionID, time() + (24*60*60),'/');
      header("Location: ../workerpage.php");
    }else{
      echo "<script>
        alert('Your password is incorrect!');
        window.location.replace(\" ../login.php \");
      </script>";
      exit();
    }
  }
}else{
  die("ERROR");
}
?>
