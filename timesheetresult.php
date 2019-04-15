<!DOCTYPE html>
<html lang="en">

<head>
    <title>Worker Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>


    <div class="container">
        <!-- NAV BAR -->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                        aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Brand</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="workerpage.php">Schedule</a></li>
                        <li><a href="#">Clock In/Out</a></li>
                        <li><a href="#">Upload Photo</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
       <h1>Your Timesheet</h1>
       
      <?php
        $server = 'localhost';
        $user = 'root';
        $pass = '';
        $dbname = 'janrenovation';
        if(isset($_POST['go'])){
          try {
            // create database
            $dbconn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
            $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            include 'controllers/functions.php';

            $starttime=$_POST['starttime'];
            $endtime=$_POST['endtime'];
            $result=$_POST['jobsites'];
            $result_explode = explode('|', $result);
            $uid = getUID();
            $pid = $result_explode[0];

            // echo "Starttime: ". $starttimedate."<br />";
            $starttimedate = date($result_explode[1] ." " .$starttime);
            $endtimedate = date($result_explode[1] ." " .$endtime);
            // echo "Project id: ". $pid."<br />";
            // echo "Starttime: ". $starttimedate."<br />";

            // echo "End time: ". $endtimedate."<br />";

            $ins=$dbconn->prepare(
              'INSERT INTO `timesheet` (uid,pid,starttime,endtime)
              VALUES (:uid,:pid,:starttime,:endtime)'
            );
            
            $ins->bindParam(':uid',$uid);
            $ins->bindParam(':pid',$pid);
            $ins->bindParam(':starttime',$starttimedate);
            $ins->bindParam(':endtime',$endtimedate);
            
            $ins->execute();
            

            $address = "";
            $borough = "";
            
            
            $s_time = "";
            $e_time = "";
            
            $query = $dbconn->prepare('
                SELECT t.uid,t.pid,t.starttime,t.endtime,p.address,p.borough
                FROM `timesheet` t,
                `projects` p
                WHERE 
                t.uid='.$uid.'
                and p.pid = t.pid
                ORDER BY starttime,endtime;'
                );
            $query->execute(array(':starttime'=>$s_time,':endtime'=>$e_time,':address'=>$address,':borough'=>$borough));
            $result = $query->fetchAll();
            // var_dump($result);
            // printf($result[0]["endtime"]);
            
            foreach($result as $value){
                // printf($value["date"]);
                $day = date("d",strtotime($value["starttime"]));
                $stime = date("H:i",strtotime($value["starttime"]));
                $etime = date("H:i",strtotime($value["endtime"]));
                $dayofweek = date("l",strtotime($value["starttime"]));
                $address = $value["address"];
                $borough = $value["borough"];
                
                echo("<li><h3>Date:</h3> $dayofweek, $day<h4>Start Time:</h4>$stime <h4>End Time:</h4>$etime <h4>Address:</h4>$address</li>");
                // echo "<option value=\"".$value["pid"]."|".$value["date"] ."\">" . $dayofweek . "," . $day . " " . $value["address"] . "</option>";
            }
            // $query = $dbconn->prepare('SELECT * FROM `timesheet` WHERE state = :d_state AND city = :d_city AND date >= :d_date AND accepted = FALSE;');
            // $query->execute(array(':d_state'=>$state,':d_city'=>$city,':d_date'=>$r_date));
            // // $query = $dbconn->prepare('SELECT * FROM `drivers`;');
            // $query->execute();
            // $result = $query->fetchAll();
            // // var_dump($result);
            // foreach($result as $value){
            //   echo("<div class = \"results\"><ul class=\"list-unstyled mt-3 mb-4\">");
            //   echo("<li><h3>Riders:$value[username]</h3></li><li>Departure Date: $value[date]</li><li>Destination: $value[city], $value[state]</li></ul>
            //     <a class='btn btn-outline-success my-2 my-sm-0' href =\"profile.php?user=$value[username]\">View Profile</a>
            //     <a class='btn btn-outline-success my-2 my-sm-0' href ='offerrideresult.php?accept=true&rideid=".$value["rideid"]."&state=".$value["state"]."&city=".$value["city"]."&date=".$value["date"]."'>Accept Ride</a>
            //     </div>");
              
            // }



            // var_dump($result);
            // echo("$result");
            
          }
          catch(PDOException $e){
            
            echo "<br>" . $e->getMessage();
          }
        }
        ?>
  

           
            
            
        
    </div>

</body>

</html>