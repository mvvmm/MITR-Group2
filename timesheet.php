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
        <form class="center_div" action="timesheetresult.php" method="post">
   

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


         
        <select name="jobsites">
            <?php 
            $server = 'localhost';
            $user = 'root';
            $pass = '';
            $dbname = 'janrenovation';
            $dbconn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
            $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $query = $dbconn->prepare('SELECT * FROM `projects`');
            include 'controllers/functions.php';

            $uid = getUID();

            $address = "";
            $borough = "";
            $date = "";
            $pid = "";
            $uid = getUID();
            // var_dump($uid);
            $query = $dbconn->prepare('
                SELECT r.uid,r.pid,p.address,p.borough,r.date
                FROM `relations` r,
                `projects` p
                WHERE 
                r.uid='.$uid.'
                and p.pid = r.pid
                ORDER BY date;'
                );
            $query->execute(array(':pid'=>$pid,':date'=>$date,':address'=>$address,':borough'=>$borough));
            $result = $query->fetchAll();

            foreach($result as $value){
                // printf($value["date"]);
                $day = date("d",strtotime($value["date"]));
                $dayofweek = date("l",strtotime($value["date"]));

                printf($dayofweek);
                printf($day);
                echo "<option value=\"".$value["pid"]."|".$value["date"] ."\">" . $dayofweek . "," . $day . " " . $value["address"] . "</option>";
            }
            // printf($result[0]["date"]);
            // printf($result[0]["address"]);
            // printf($result[0]["borough"]);

            // var_dump($result);
        ?>
        
        </select>
         <button class="btn btn-outline-success" type="submit"name="go">GO</button>
  </form>   
        
    </div>

</body>

</html>