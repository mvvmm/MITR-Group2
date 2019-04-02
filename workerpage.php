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
                        <li><a href="#">Schedule</a></li>
                        <li><a href="#">Clock In/Out</a></li>
                        <li><a href="#">Upload Photo</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="sub-container" style="padding-left:15px; padding-right:15px;">
            <div class="row" style="padding-bottom: 15px;">
                <div class="col-sm-12">
                    <h3>Your Work Schedule</h3>
                </div>
            </div>

            <?php
            $server = 'localhost';
            $user = 'root';
            $pass = '';
            $dbname = 'janrenovation';
            $dbconn = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
            $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $starttime = "";
            $endtime = "";
            

            // var_dump(document);
            $query = $dbconn->prepare('SELECT * FROM `timesheet` WHERE uid=3 ORDER BY starttime,endtime;');
            $query->execute(array(':starttime'=>$starttime,':endtime'=>$endtime));
            $result = $query->fetchAll();
            // printf($result[0]["endtime"]);
            $arr= array();
            foreach($result as $value){
                $stime = date("H:i",strtotime($value["starttime"]));
                $dayofweek = date("l",strtotime($value["starttime"]));

                // printf($stime);
                // printf($dayofweek);

            }
            // var_dump($result);
            echo "
            <script> 
            $(document).ready(function(){
                var arr = ".json_encode($result).";
                console.log(arr);
                var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
                for(var i=0;i<arr.length;i++){
                    var startdate = new Date(arr[i]['starttime']);
                    var enddate = new Date(arr[i]['endtime']);
                    var dayofweek = days[startdate.getDay()];
                    var starttime = startdate.toLocaleTimeString('en-US');
                    var endtime = enddate.toLocaleTimeString('en-US');
                    
                    //If we are including multiple job sites in a day. CreateElement('div') to block off info for one

                    var node = document.createElement('li'); 
                    var textnode = document.createTextNode(dayofweek);  
                    node.appendChild(textnode);
                    document.getElementById(dayofweek).appendChild(node);

                    var node = document.createElement('li'); 
                    var textnode = document.createTextNode(starttime);  
                    node.appendChild(textnode);
                    document.getElementById(dayofweek).appendChild(node);

                    var node = document.createElement('li'); 
                    var textnode = document.createTextNode(endtime);  
                    node.appendChild(textnode);
                    document.getElementById(dayofweek).appendChild(node);
                }
                console.log(document);
            
                
            })
            
            </script>"

            ?>
            
            
            
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Monday</th>
                        <th scope="col">Tuesday</th>
                        <th scope="col">Wednesday</th>
                        <th scope="col">Thursday</th>
                        <th scope="col">Friday</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <ul id= "Monday">
                            </ul>
                        </td>
                        <td><ul id= "Tuesday">
                            </ul>
                        </td>
                        <td><ul id= "Wednesday">
                            </ul>
                        </td>
                        <td><ul id= "Thursday">
                            </ul>
                        </td>
                        <td><ul id= "Friday">
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3/12/2019</th>
                        <td>Tuesday</td>
                        <td>9:00 AM</td>
                        <td>5:00 PM</td>
                        <td>256 4th Street</td>
                    </tr>
                    <tr>
                        <th scope="row">3/13/2019</th>
                        <td>Wednesday</td>
                        <td>9:00 AM</td>
                        <td>5:00 PM</td>
                        <td>256 4th Street</td>
                    </tr>
                </tbody>
            </table>
            
            
        </div>
    </div>

</body>

</html>