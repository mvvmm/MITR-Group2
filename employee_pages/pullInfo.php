<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>JANRenovation</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
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


$sql = "SELECT * FROM users WHERE privilege='employee'";
$result = mysqli_query($conn, $sql);

echo('  <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>'.$day0.'</th>
                    <th>'.$day1.'</th>
                    <th>'.$day2.'</th>
                    <th>'.$day3.'</th>
                    <th>'.$day4.'</th>
                </tr>
            </thead>
            <tbody>
');

if (mysqli_num_rows($result) > 0) {
    // for each user
    while($row = mysqli_fetch_assoc($result)) {

        // print name
        echo('
            <tr>
                <td>'.$row["firstname"] .' '. $row["lastname"].'</td>
        ');




        //echo("\t");

        // Get all the project ids and dates of those projects for the user
        $uid = $row["uid"];
        $sql2 = "SELECT * FROM relations WHERE uid=$uid";

        // Loop through 5 days
        for ($x = 0; $x < 5; $x++) {
            $result2 = mysqli_query($conn, $sql2);
            // Loop through all the relations for that user
            $printed = False;
            while($row2 = mysqli_fetch_assoc($result2)) {
                if (substr($row2["date"], 0, 10) == $daysArr[$x]) {
                    $printed = True;
                    echo(
                        '<td>'.$row2["date"].'</td>'
                    );
                    break;
                }
            }
            if ($printed == False) {
                echo('<td></td>');
            }
        }


        echo("<tr></tr>");

    }
} else {
    echo "0 results";
}



?>

</body>
</html>
