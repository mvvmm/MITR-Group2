<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>JANRenovation</title>
</head>
<body>
<h1>Index</h1>

<?php
$database = parse_ini_file("../controllers/db_config.ini");
$host = $database['host'];
$db_username = $database['username'];
$password = $database['password'];
$databasename = $database['dbname'];
include '../controllers/functions.php';
require_once('../controllers/db_connector.php');
$conn = mysqli_connect($host, $db_username, $password, $databasename);

date_default_timezone_set('US/Eastern');
$date = date('Y-m-d h:i:s a', time());



$day0 = date('Y-m-d');
$day1 = date('Y-m-d', strtotime("+1 days"));
$day2 = date('Y-m-d', strtotime("+2 days"));
$day3 = date('Y-m-d', strtotime("+3 days"));
$day4 = date('Y-m-d', strtotime("+4 days"));
$daysArr = array($day0, $day1, $day2, $day3, $day4);

echo($date);
echo("<br>");
echo($day0);
echo("<br>");
echo(substr($date, 0, 10));
echo("<br>");
if (substr($date, 0, 10) == $day0) {
    echo("true");
} else {
    echo("false");
}

$sql = "SELECT * FROM users WHERE privilege='employee'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // for each user
    while($row = mysqli_fetch_assoc($result)) {

        // print name
        echo($row["firstname"] . " " . $row["lastname"]);
        echo("\t");

        // Get all the project ids and dates of those projects for the user
        $uid = $row["uid"];
        $sql2 = "SELECT * FROM relations WHERE uid=$uid";

        // Loop through 5 days
        for ($x = 0; $x < 5; $x++) {
            $result2 = mysqli_query($conn, $sql2);
            // Loop through all the relations for that user
            while($row2 = mysqli_fetch_assoc($result2)) {
                if (substr($row2["date"], 0, 10) == $daysArr[$x]) {
                    echo($row2["date"]);
                }
                //echo(substr($row2["date"], 0, 8));
            }
        }


        echo("<br>");

    }
} else {
    echo "0 results";
}



?>

</body>
</html>
