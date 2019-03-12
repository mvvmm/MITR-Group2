<?php
function dbConnect(){
  //All the secret good stuff like passwords and database name are in here
  $database = parse_ini_file("db_config.ini");
  $host = $database['host'];
  $db_username = $database['username'];
  $password = $database['password'];
  $databasename = $database['dbname'];
  $connection = new PDO("mysql:host=$host;dbname=$databasename", $db_username, $password);
  // set the PDO error mode to exception
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $connection;
}
 ?>
