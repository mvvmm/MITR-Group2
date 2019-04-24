<?php
require_once 'functions.php';
$privilege = getPrivilege();
if ($privilege != 'admin' && $privilege != 'scheduler'){
  echo "<script type='text/javascript'>
          alert('You do not have permission to access this page.');
          window.location.replace('./index.php');
        </script>";
  exit();
}
?>
