<?php
include_once "db_connector.php";
if(isset($_POST['email']) && isset($_POST['password'])){

  //Check if both passwords match
  if ($_POST['password'] != $_POST['password2']){
    echo "<script type='text/javascript'>
            alert('Passwords do not match!');
            window.location.replace(\" ../create_account.php \");
          </script>";
    exit();
  }
  //Check is phone number is 10 characters long
  if(strlen($_POST['phone']) != 10){
    echo "<script type='text/javascript'>
            alert('The phone number you entered was not 10 digits long!');
            window.location.replace(\" ../create_account.php \");
          </script>";
    exit();
  }
  $first = $_POST['first'];
  $last = $_POST['last'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

  $conn = dbConnect();
  $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
  $stmt->bindParam(':email',$email);
  $stmt->execute();
  $duplicate_user = $stmt->fetch();
  if($duplicate_user){
    //Redirects the user to the create account page again and displays an error
    echo "<script type='text/javascript'>
              alert('An account with that e-mail already exists!');
              window.location.replace(\" ../create_account.php \");
          </script>";
    exit();
  }
  $stmt = $conn->prepare('INSERT INTO users (firstname, lastname, privilege, phone, email, password, approved)
    VALUES (:firstname, :lastname, "employee", :phone, :email, :password, 0)');
  $stmt->bindParam(':firstname',$first);
  $stmt->bindParam(':lastname',$last);
  $stmt->bindParam(':phone',$phone);
  $stmt->bindParam(':email',$email);
  $stmt->bindParam(':password',$password);
  $stmt->execute();
  echo "<script type='text/javascript'>
            alert('Account created successfully. Please wait for an admin to approve your account.');
            window.location.replace(\" ../index.php \");
        </script>";
  exit();
}else{
  die("ERROR");
}
?>
