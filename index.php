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
    
    // function to make array of weekdays from array or all days
    function noWeekends($daysArray) {
      
      $newDaysArray = [];

      foreach ($daysArray as $x => $date) {
        $weekDay = date('w', strtotime($date));
       
        // check if weekday and add to new array
        if($weekDay != 0 && $weekDay != 6) {
          array_push($newDaysArray, $daysArray[$x]);
        }
      }

      return $newDaysArray;
    }

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

    // build dates for next 7 days
    $day0 = date('Y-m-d');
    $day1 = date('Y-m-d', strtotime("+1 days"));
    $day2 = date('Y-m-d', strtotime("+2 days"));
    $day3 = date('Y-m-d', strtotime("+3 days"));
    $day4 = date('Y-m-d', strtotime("+4 days"));
    $day5 = date('Y-m-d', strtotime("+5 days"));
    $day6 = date('Y-m-d', strtotime("+6 days"));
    $next7Days = array($day0, $day1, $day2, $day3, $day4, $day5, $day6);
    $next5WeekDays = noWeekends($next7Days);

    // build SQL query to grab all employees
    $sqlGetEmployees = "SELECT * FROM users WHERE privilege='employee'";
    $allEmployees = mysqli_query($conn, $sqlGetEmployees);

    // html build table header
    echo(' <div class="container"> 
              <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Employee</th> ');

    // build headers for next 5 days                    
    for ($x = 0; $x < 5; $x++) {
      echo('<th>'.$next5WeekDays[$x].'</th>');
    }

    echo('
                    </tr>
                  </thead>
                <tbody>    
    ');

    // loop through all employees in database
    if (mysqli_num_rows($allEmployees) > 0) {
        // for each user
        while($employee = mysqli_fetch_assoc($allEmployees)) {

            // add row with name
            echo('
                <tr>
                    <td>'.$employee["firstname"] .' '. $employee["lastname"].'</td>
            ');

            // get all the project ids and dates of those projects for the user
            $uid = $employee["uid"];
            $sqlGetRelations = "SELECT * FROM relations WHERE uid=$uid";

            // loop through 5 days
            for ($x = 0; $x < 5; $x++) {
                $projectRelations = mysqli_query($conn, $sqlGetRelations);

                // Loop through all the relations for that user
                $printed = False;
                while($project = mysqli_fetch_assoc($projectRelations)) {

                  $currentDay = substr($project["date"], 0, 10);                    
                  if ($currentDay == $next5WeekDays[$x]) {
                      $printed = True;
                      echo(
                          '<td>'.$project["date"].'</td>'
                      );
                      break;
                  } 
                }
                // print blank cell if no data
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
