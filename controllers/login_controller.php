<?php
include_once "db_connector.php";
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
  }else{
    if(password_verify($user_pass,$user['password'])){
      // Do session stuff here but for right now we'll just redirect to index.
      header("Location: ../index.php");
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
