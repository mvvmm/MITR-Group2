<!DOCTYPE html>
<html lang="en">

<head>
    <title>Worker Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "script.php";?>
    <?php include "style.php";?>
    <?php require "controllers/functions.php";?>
</head>

<body>
  <div class="p-5">
    <?php include 'navbar.php';?>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-9 mx-auto">
        <div class="card shadow-lg my-3">
          <div class="card-body">
            <h1 class="card-title text-center">Clock In/Out</h1><hr />
            <form action="controllers/clock_IO_controller.php" method="post">

              <div class="form-row">
                <div class="form-group col-md-4 mx-auto">
                  <select class="form-control text-center" name="IO">
                    <option value='in'>Clock In</option>
                    <option value='out'>Clock Out</option>
                  </select>
                </div>
              </div>


              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                      <input type="text" name="dateTime" class="form-control datetimepicker-input" data-target="#datetimepicker1" placeholder="Date and Time" required/>
                      <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                </div>

              <div class="col-md-6">
                <div class="form-group">
                  <select class="form-control" name="projectAddress" required>
                    <option selected disabled>Project Address</option>
                    <?php generateUsersActiveProjects();?>
                  </select>
                </div>
              </div>
            </div>

            <div class="text-center">
              <button class="btn btn-dark btn-clock text-uppercase" type="submit" name="submit">Submit</button>
            </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="container">
    <form action="timesheetresult.php" method="post">
      <div class="row">
        <div class="col">
          <p>Enter a Start Time:</p><input name="starttime" type="text" class="form-control" placeholder="Start Time">
        </div>
        <div class="col">
        <p>Enter a End Time:</p>
          <input name="endtime" type="text" class="form-control" placeholder="End Time">
        </div>
      </div>
    <br>

    <br>



    <select name="jobsites"> -->
        <?php
        // $server = 'localhost';
        // $user = 'root';
        // $pass = '';
        // $dbname = 'janrenovation';
        // $dbconn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
        // $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // // $query = $dbconn->prepare('SELECT * FROM `projects`');
        // include 'controllers/functions.php';
        //
        // $uid = getUID();
        //
        // $address = "";
        // $borough = "";
        // $date = "";
        // $pid = "";
        // $uid = getUID();
        // // var_dump($uid);
        // $query = $dbconn->prepare('
        //     SELECT r.uid,r.pid,p.address,p.borough,r.date
        //     FROM `relations` r,
        //     `projects` p
        //     WHERE
        //     r.uid='.$uid.'
        //     and p.pid = r.pid
        //     ORDER BY date;'
        //     );
        // $query->execute(array(':pid'=>$pid,':date'=>$date,':address'=>$address,':borough'=>$borough));
        // $result = $query->fetchAll();
        //
        // foreach($result as $value){
        //     // printf($value["date"]);
        //     $day = date("d",strtotime($value["date"]));
        //     $dayofweek = date("l",strtotime($value["date"]));
        //
        //     printf($dayofweek);
        //     printf($day);
        //     echo "<option value=\"".$value["pid"]."|".$value["date"] ."\">" . $dayofweek . "," . $day . " " . $value["address"] . "</option>";
        // }
        // printf($result[0]["date"]);
        // printf($result[0]["address"]);
        // printf($result[0]["borough"]);
        //
        // var_dump($result);
    ?>

    <!-- </select>
     <button class="btn btn-outline-success" type="submit"name="go">GO</button>
  </form>

  </div> -->




<script type="text/javascript" src="js/clock_IO.js"></script>
</body>

</html>
