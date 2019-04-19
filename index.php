<?php require_once 'controllers/functions.php'?>
<!doctype html>
<html>
<head>
  <?php include 'style.php'?>
  <?php include 'script.php'?>
  <meta charset="utf-8">
  <title>JANRenovation</title>
</head>
<body>
  <div class="p-5">
    <?php include 'navbar.php';?>
  </div>
  <?php
  $user_type = getPrivilege();
  if($user_type == "employee"){?>

  <div class="container-fluid pt-5">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="pt-5 pb-2">Your Work Schedule</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-2 col-md-12 m-auto">
        <table class="table table-bordered">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Monday</th></tr>
          </thead>
          <tbody id="Monday"></tbody>
        </table>
      </div>

      <div class="col-lg-2 col-md-12 m-auto">
        <table class="table table-bordered">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Tuesday</th></tr>
          </thead>
          <tbody id="Tuesday"></tbody>
        </table>
      </div>

      <div class="col-lg-2 col-md-12 m-auto">
        <table class="table table-bordered">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Wednesday</th></tr>
          </thead>
          <tbody id="Wednesday"></tbody>
        </table>
      </div>

      <div class="col-lg-2 col-md-12 m-auto">
        <table class="table table-bordered">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Thursday</th></tr>
          </thead>
          <tbody id="Thursday"></tbody>
        </table>
      </div>

      <div class="col-lg-2 col-md-12 m-auto">
        <table class="table table-bordered">
          <thead class='thead-dark'>
            <tr><th scope="col-sm-1">Friday</th></tr>
          </thead>
          <tbody id="Friday"></tbody>
        </table>
      </div>
    </div>
  </div>


    <?php generateUserSchedule();
  } elseif($user_type == "scheduler"){
    
    // build database connection
    $database = parse_ini_file("controllers/db_config.ini");
    $host = $database['host'];
    $db_username = $database['username'];
    $password = $database['password'];
    $databasename = $database['dbname'];
    $conn = mysqli_connect($host, $db_username, $password, $databasename);
    
    // set timezone and current date
    date_default_timezone_set('US/Eastern');
    $date = date('Y-m-d h:i:s a', time());

    // build dates for next 5 days
    $day0 = date('Y-m-d');
    $day1 = date('Y-m-d', strtotime("+1 days"));
    $day2 = date('Y-m-d', strtotime("+2 days"));
    $day3 = date('Y-m-d', strtotime("+3 days"));
    $day4 = date('Y-m-d', strtotime("+4 days"));
    $daysArr = array($day0, $day1, $day2, $day3, $day4);

    // build SQL query to grab all employees
    $sql = "SELECT * FROM users WHERE privilege='employee'";
    $result = mysqli_query($conn, $sql);

    // html build table header
    echo(' <div class="container"> 
              <table class="table table-bordered">
                <thead class="thead-dark">
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

    // loop through all employees in database
    if (mysqli_num_rows($result) > 0) {
        // for each user
        while($row = mysqli_fetch_assoc($result)) {

            // add row with name
            echo('
                <tr>
                    <td>'.$row["firstname"] .' '. $row["lastname"].'</td>
            ');

            // get all the project ids and dates of those projects for the user
            $uid = $row["uid"];
            $sql2 = "SELECT * FROM relations WHERE uid=$uid";

            // loop through 5 days
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
    }?>

    </body>

    </html>

    <?php
  } elseif($user_type == "admin"){?>
    <br><br>
    <h1>Admin Test</h1>
    <?php
  } else {
    header("Location: login.php");
  }?>
</body>
</html>
