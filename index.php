<?php require_once 'controllers/functions.php'?>
<!doctype html>
<html lang="en">
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
    // color constants
    $BronxColor        = "#80e5fc"; // blue
    $BrooklynColor     = "#ffe270"; // yellow
    $ManhattenColor    = "#f46666"; // red
    $QueensColor       = "#aaf26f"; // green
    $StatenIslandColor = "#e2aaff"; // purple 
    
    $BronxTextColor        = "#2c5b66"; // dark blue
    $BrooklynTextColor     = "#7f6e2a"; // dark yellow
    $ManhattenTextColor    = "#681f1f"; // dark red
    $QueensTextColor       = "#3b5e1f"; // dark green
    $StatenTextIslandColor = "#4b3159"; // dark purple 
    ?>

    <!-- build legend -->
    <div class="container"> 
      <table class="table text-center table-fluid">
          <thead class="thead-dark font-weight-bold">
            <tr>
              <?php 
                echo('
                <td style="width: 20%; background-color:'.$BronxColor.'; color:'.$BronxTextColor.';">Bronx</td>    
                <td style="width: 20%; background-color:'.$BrooklynColor.'; color:'.$BrooklynTextColor.';">Brooklyn</td>         
                <td style="width: 20%; background-color:'.$ManhattenColor.'; color:'.$ManhattenTextColor.';"; >Manhattan</td>        
                <td style="width: 20%; background-color:'.$QueensColor.'; color:'.$QueensTextColor.';">Queens</td>
                <td style="width: 20%; background-color:'.$StatenIslandColor.'; color:'.$StatenTextIslandColor.';">Staten Island</td>
                ');
              ?>
            </tr>
          </thead>
      </table>


    <?php
    class Employee {
      private $uid;
      private $fname;
      private $lname;
      public $projects; // $projects({date} => [proj_1, proj_2, ...])

      public function __construct($uid, $fname, $lname) {
        $this->uid = $uid;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->projects = array();
      }
  
      public function getProjects() {
        return $this->projects;
      }

      public function getFirstName() {
        return $this->fname;
      }

      public function getLastName() {
        return $this->lname;
      }

      public function getUID() {
        return $this->uid;
      }

      public function addProject($date, $project) { 
        $shared = False;
        // check if project shares date
        foreach($this->projects as $curDateProj) {
          if ($date == $curDateProj) {
            array_push($curDateProj[$date], $project);
            $shared = True;
          }
        }
        if (!$shared) {
          $projEntry = array($date=>[$project]);
          array_push($this->projects, $projEntry);
        }
     
      }
    }

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

    // function used to determine cell fill color
    function whatColor($borough) {
      $color = "";
      if ($borough == 'Manhattan') { 
        $color = "#f46666"; 
      } elseif ($borough == 'Bronx') {  
        $color = "#80e5fc"; 
      } elseif ($borough == 'Brooklyn') { 
        $color = "#ffe270"; 
      } elseif ($borough == 'Queens') { 
        $color = "#aaf26f"; 
      } elseif ($borough == 'Staten Island') { 
        $color = "#e2aaff"; 
      }
      return $color;
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
    echo(' 
              <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th rowspan="2">Employee</th> ');

    // build headers for next 5 days
    // row 1 - day of week                    
    for ($x = 0; $x < 5; $x++) {
      $nameOfDay = date('l', strtotime($next5WeekDays[$x]));
      echo(
        '<th>'.$nameOfDay.'</th>
      ');
    }
    echo('  </tr>
              <tr>
          
    ');
    // row 2 - exact date mm-dd              
    for ($x = 0; $x < 5; $x++) {
      $nameOfDay = date('D', strtotime($next5WeekDays[$x]));
      echo(
        '<th>'.substr($next5WeekDays[$x], 5).'</th>
      ');
    }

    echo('
                    </tr>
                  </thead>
                <tbody>    
    ');

    // loop through all employees in database
    $employeeProjectMap = [];
    if (mysqli_num_rows($allEmployees) > 0) {

        // for each employee
        while($employee = mysqli_fetch_assoc($allEmployees)) {        
            echo($employee["firstname"].'<br>');
            // check if employee already in array
            $flagIsIn = False;
            $uid = $employee["uid"];  
            foreach($employeeProjectMap as $curEmployee) {
              echo($curEmployee->getUID().' = '.$uid.' => ');
              if ($curEmployee->getUID() == $uid) {
                $thisEmployee = $curEmployee;
                $flagIsIn = True;
                //echo($curEmployee->getUID().' = '.$uid);
                break;
              }
            }
            echo('<br><br>'); //debug
            // make new if none exists
            if (!$flagIsIn) {               
              $fname = $employee["firstname"];
              $lname = $employee["lastname"];
              $thisEmployee = new Employee($uid, $fname, $lname);
            } 
           
            /*
            // add row with name
            echo('
                <tr>
                    <td>'.$employee["firstname"] .' '. $employee["lastname"].'</td>
            ');
            */
            // get all the project ids and dates of those projects for the user
            $sqlGetRelations = "SELECT * FROM relations WHERE uid=$uid";

            // loop through 5 days
            for ($x = 0; $x < 5; $x++) {
                $allRelations = mysqli_query($conn, $sqlGetRelations);

                // Loop through all the relations for that user
                $printed = False;
                $curEmployeeProj = [];
                while($relation = mysqli_fetch_assoc($allRelations)) {
                  
                  // get this relation project from project table
                  $pid = $relation["pid"];
                  $sqlGetProject = "SELECT * FROM projects WHERE pid=$pid";
                  $projectData = mysqli_query($conn, $sqlGetProject);
                  $project = mysqli_fetch_assoc($projectData);

                  $currentDay = substr($relation["date"], 0, 10);   
                  // if day in next 5 weekdays                 
                  if ($currentDay == $next5WeekDays[$x]) {
                      $thisEmployee->addProject($relation["date"], $project); // add prject to this employee object
                      $printed = True;
                      //$buroughColor = whatColor($project["borough"]);
                      //echo('<td style="background-color:'.$buroughColor.';">'.$project["address"].'</td>');
                      break;
                  } 
                }
                // print blank cell if no data
                if ($printed == False) {
                    //echo('<td></td>');
                }
            }
            //print_r($thisEmployee->projects); // debug
            //echo("<tr></tr>");
            array_push($employeeProjectMap, $thisEmployee);
        }
        var_dump($employeeProjectMap);
    } else {
        echo "0 results";
    }
    
    foreach($employeeProjectMap as $employee) {
      // add row with name
      echo('
              <tr>
                <td>'.$employee->getFirstName().' '. $employee->getLastName().'</td>
      ');
      $projects = $employee->getProjects();
      foreach($projects as $project) {
        
      }
      $buroughColor = whatColor($project["borough"]);
      echo('<td style="background-color:'.$buroughColor.';">'.$project["address"].'</td>');
      echo("<tr></tr>");
    }
/*
    // debug
    foreach($employeeProjectMap as $employeeObj) {
      $employeeProject = $employeeObj->getProjects();
      var_dump($employeeProject);
      echo('<br><br>');
      
      foreach($employeeProject as $curProject) {
        print_r($employeeObj->getName().' ');
        var_dump($curProject);
        echo('<br><br>');
   
    }
       }*/
    ?>

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
