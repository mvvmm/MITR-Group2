<?php
require_once "db_connector.php";
require_once "functions.php";
if(isset($_POST['email'])){
    $conn = dbConnect();
    $email = $_POST['email'];
    $stmt = $conn->prepare('SELECT * FROM users WHERE email=:email');
    $stmt->bindParam(':email',$email);
    $stmt->execute();
    $user = $stmt->fetch();
    if(!$user){
        echo "E-mail does not exist.";
    }
    else{
      if(getUID() == $user['uid']  || getPrivilege() == 'admin'){
        echo $user['firstname']." ";
        echo $user['lastname']." ";
        echo $user['phone']." ";
        echo $user['privilege']." ";
      }else{
        echo "You do not have permission to look up this account.";
      }
    }
}
else{
    echo "Did not fill in an e-mail.";
}
?>
