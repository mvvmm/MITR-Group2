<?php
require_once "db_connector.php";
require_once "functions.php";
if(isset($_POST['email'])){

  $conn = dbConnect();
  $email = $_POST['email'];
  $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
  $stmt->bindParam(':email',$email);
  $stmt->execute();
  $user = $stmt->fetch();

  // Password not changed
  if(!(isset($_POST['password']))){
    $stmt = $conn->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, phone = :phone, email = :email, privilege = :privilege WHERE uid = :uid');
    $uid = $user['uid'];

    if(isset($_POST['first']) && $_POST['first'] != ''){
      $first = $_POST['first'];
    }else{
      $first = $user['firstname'];
    }

    if(isset($_POST['last']) && $_POST['last'] != ''){
      $last = $_POST['last'];
    }else{
      $last = $user['lastname'];
    }

    if(isset($_POST['phone']) && $_POST['phone'] != ''){
      $phone = $_POST['phone'];
    }else{
      $phone = $user['phone'];
    }

    if(isset($_POST['email']) && $_POST['email'] != ''){
      $email = $_POST['email'];
    }else{
      $email = $user['email'];
    }

    if (isset($_POST['privilege'])){
      $privilege = $_POST['privilege'];
    }else{
      $privilege = $user['privilege'];
    }

    //bind the params to the query
    $stmt->bindParam(':firstname',$first);
    $stmt->bindParam(':lastname',$last);
    $stmt->bindParam(':phone',$phone);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':privilege',$privilege);
    $stmt->bindParam(':uid',$uid);

    if ($user['uid'] == getUID() || getPrivilege() == 'admin'){
      $stmt->execute();
      header("Location: ../index.php");
      exit();
    }else{
      echo "<script type='text/javascript'>
                alert('You do not have permission to edit this account.');
                window.location.replace(\" ../edit_account.php \");
            </script>";
      exit();
    }
  }

  // Password changed
  else{
    $stmt = $conn->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, phone = :phone, email = :email, password = :password, privilege = :privilege WHERE uid = :uid');
    $uid = $user['uid'];

    if(isset($_POST['first']) && $_POST['first'] != ''){
      $first = $_POST['first'];
    }else{
      $first = $user['firstname'];
    }

    if(isset($_POST['last']) && $_POST['last'] != ''){
      $last = $_POST['last'];
    }else{
      $last = $user['lastname'];
    }

    if(isset($_POST['phone']) && $_POST['phone'] != ''){
      $phone = $_POST['phone'];
    }else{
      $phone = $user['phone'];
    }

    if(isset($_POST['email']) && $_POST['email'] != ''){
      $email = $_POST['email'];
    }else{
      $email = $user['email'];
    }

    if(isset($_POST['password']) && $_POST['password'] != ''){
      $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    }else{
      $password = $user['password'];
    }

    if (isset($_POST['privilege'])){
      $privilege = $_POST['privilege'];
    }else{
      $privilege = $user['privilege'];
    }

    //assign params to query
    $stmt->bindParam(':firstname',$first);
    $stmt->bindParam(':lastname',$last);
    $stmt->bindParam(':phone',$phone);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':password',$password);
    $stmt->bindParam(':privilege',$privilege);
    $stmt->bindParam(':uid',$uid);

    if ($user['uid'] == getUID() || getPrivilege() == 'admin'){
      $stmt->execute();
      header("Location: ../index.php");
      exit();
    }else{
      echo "<script type='text/javascript'>
                alert('You do not have permission to edit this account.');
                window.location.replace(\" ../edit_account.php \");
            </script>";
      exit();
    }
  }
}else{
  die("ERROR");
}
?>
