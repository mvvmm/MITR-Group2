    <?php
    include 'borough_colors.php';
    
    class Employee {
      private $uid;
      private $fname;
      private $lname;
      private $projects; // $projects({date} => [proj_1, proj_2, ...])

      public function __construct($uid, $fname, $lname) {
        $this->uid = $uid;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->projects = array();
      }
  
      public function getProjects() {
        return $this->projects;
      }

      public function getMaxProjectsInOneDay() {
        $maxProjectsInOneDay = 0;
        foreach($this->projects as $curDateProj) {
          $curKey = key($curDateProj);   
          if (count($curDateProj[$curKey]) > $maxProjectsInOneDay) {
            $maxProjectsInOneDay = count($curDateProj[$curKey]);
          }
        }

        return $maxProjectsInOneDay;
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
        foreach($this->projects as &$curDateProj) {
          if ($date == key($curDateProj)) {
            array_push($curDateProj[$date], $project);
            $shared = True;
          }
        }
        // no project already on date
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

    // loop through all employees in database and add data to an array
    $employeeProjectMap = [];
    if (mysqli_num_rows($allEmployees) > 0) {

      // for each employee
      while($employee = mysqli_fetch_assoc($allEmployees)) {        

        // check if employee already in array
        $flagIsIn = False;
        $uid = $employee["uid"];  
        foreach($employeeProjectMap as $curEmployee) {
          if ($curEmployee->getUID() == $uid) {
            $thisEmployee = $curEmployee;
            $flagIsIn = True;
            break;
          }
        }
        
        // make new if none exists
        if (!$flagIsIn) {               
          $fname = $employee["firstname"];
          $lname = $employee["lastname"];
          $thisEmployee = new Employee($uid, $fname, $lname);
        } 
        
        // get all the project ids and dates of those projects for the user
        $sqlGetRelations = "SELECT * FROM relations WHERE uid=$uid";
        
        // loop through all relations for current employee
        $allRelations = mysqli_query($conn, $sqlGetRelations);
        while($relation = mysqli_fetch_assoc($allRelations)) {

          // if date of project within 5 days add to employee object
          $currentDay = substr($relation["date"], 0, 10);  
          if(in_array($currentDay, $next5WeekDays)) {

            // get this relation project from project table
            $pid = $relation["pid"];
            $sqlGetProject = "SELECT * FROM projects WHERE pid=$pid";
            $projectData = mysqli_query($conn, $sqlGetProject);
            $project = mysqli_fetch_assoc($projectData);

            $thisEmployee->addProject(substr($relation["date"], 0, 10), $project); // add project to this employee object
          }
        }
        array_push($employeeProjectMap, $thisEmployee); // add employee to list of employees
      }
    } else {
        echo "0 results";
    }
 
    // loop through all employees and print out table
    foreach($employeeProjectMap as &$employee) {
      
      // add row with name
      $rowSpanVal = $employee->getMaxProjectsInOneDay();
      $projects = $employee->getProjects();

      // fill with all blank values if no projects
      if ($rowSpanVal == 0) {
        echo('
            <tr>
                <td>'.$employee->getFirstName().' '. $employee->getLastName().'</td>
        ');
        for ($j = 0; 5 > $j; $j++) {
            echo('<td>&nbsp</td>');
        }
        echo('</tr>');
      } else {
        echo('
            <tr>
                <td rowspan="'.$rowSpanVal.'">'.$employee->getFirstName().' '. $employee->getLastName().'</td>
        ');
      }

      // create all rows for current employee
      for($i = 0; $i < $rowSpanVal; $i++) {

        // start new row if one or more already complete
        if ($i >= 1) {
          echo('<tr>');
        }
        
        // loop through next 5 days
        foreach($next5WeekDays as $curTableDate) {
          $printed = False;
          // loop through projects by groupped by date
          foreach($projects as &$projectDayContainer) {
           
            // loop through all projects of associated date
            foreach($projectDayContainer as $projectDate => &$projectList) {
              
              // check if project on that day
              if ($curTableDate == $projectDate) {
               
                // output and delete first project associated with date
                $buroughColor = whatColor($projectList[0]["borough"]);
                echo('<td style="background-color:'.$buroughColor.';">'.$projectList[0]["address"].'</td>');
                array_shift($projectList); // remove to avoid duplicates
                $printed = True;
                
                // remove date entry if empty
                if (count($projectList) == 0) {
                  unset($projectDayContainer[$projectDate]);
                }
              }
 
            }
          } 
          // if no project on that day make empty cell
          if ($printed == False) {
            echo('<td></td>');
          }
        }
        echo('</tr>'); 
      }
    }
    ?>