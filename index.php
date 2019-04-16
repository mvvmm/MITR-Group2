<?php require_once 'controllers/functions.php'?>
<!doctype html>
<html>
<head>
  <?php include 'style.php'?>
  <meta charset="utf-8">
  <title>JANRenovation</title>
</head>
<body>
<?php include 'navbar.php'; ?>
<h1>Index</h1>
 <?php
	$user_type = getPrivilege();
	if($user_type == "employee"){
		$uid = getUID();
	  
		$conn = dbConnect();
		$stmt = $conn->prepare('SELECT r.date,p.address,p.borough FROM relations r, projects p WHERE r.uid = :uid AND r.pid = p.pid AND p.active = 1');
		$stmt->bindParam(':uid', $uid);
		$stmt->execute();
		$result = $stmt->fetchAll();
		// var_dump($result);
		echo("<div class=\"sub-container\" style=\"padding-left:15px; padding-right:15px;\">
            <div class=\"row\" style=\"padding-bottom: 15px;\">
                <div class=\"col-sm-12\">
                    <h3>Your Work Schedule</h3>
                </div>
            </div>");


         echo("<div class=\"row\">
                <div class=\"col-md-3\">
                    <table class=\"table table-bordered\" id = \"Monday\">
                        <thead>
                            <tr>
                                <th scope=\"col-sm-1\">Monday</th>
                            </tr>
                        </thead>
                        <tbody>");
        foreach($result as $value){

        	$dayofweek = date("l",strtotime($value["date"]));
        	
        	if($dayofweek=="Monday"){
        		echo("<tr><td scope=\"row\">".$value["address"].", ".$value["borough"]."</td></tr>");
        	}
        }
        echo("			</tbody>
                    </table>
                </div>
                <div class=\"col-md-3\">
                    <table class=\"table table-bordered\" id = \"Tuesday\">
                        <thead>
                            <tr>
                                <th scope=\"col-sm\">Tuesday</th>
                            </tr>
                        </thead>
                        <tbody>");

        foreach($result as $value){
        	$dayofweek = date("l",strtotime($value["date"]));
        	if($dayofweek=="Tuesday"){
        		echo("<tr><td scope=\"row\">".$value["address"].", ".$value["borough"]."</td></tr>");
        	}
        }                   
        echo("         </tbody>
                    </table>
                </div>
                <div class=\"col-md-3\">
                    <table class=\"table table-bordered\" id = \"Wednesday\">
                        <thead>
                            <tr>
                                <th scope=\"col-sm\">Wednesday</th>
                            </tr>
                        </thead>
                        <tbody>");
        foreach($result as $value){
        	$dayofweek = date("l",strtotime($value["date"]));
        	if($dayofweek=="Wednesday"){
        		echo("<tr><td scope=\"row\">".$value["address"].", ".$value["borough"]."</td></tr>");
        	}
        }           
        echo("                </tbody>
                    </table>
                </div>
                <div class=\"col-md-3\">
                    <table class=\"table table-bordered\"id = \"Thursday\">
                        <thead>
                            <tr>
                                <th scope=\"col-sm\">Thursday</th>
                            </tr>
                        </thead>
                        <tbody>");
        foreach($result as $value){
        	$dayofweek = date("l",strtotime($value["date"]));
        	if($dayofweek=="Thursday"){
        		echo("<tr><td scope=\"row\">".$value["address"].", ".$value["borough"]."</td></tr>");
        	}
        }                 
        echo("                </tbody>
                    </table>
                </div>
                <div class=\"col-md-3\">
                    <table class=\"table table-bordered\" id = \"Friday\">
                        <thead>
                            <tr>
                                <th scope=\"col-sm-1\">Friday</th>
                            </tr>
                        </thead>
                        <tbody>");
        foreach($result as $value){
        	$dayofweek = date("l",strtotime($value["date"]));
        	if($dayofweek=="Friday"){
        		echo("<tr><td scope=\"row\">".$value["address"].", ".$value["borough"]."</td></tr>");
        	}
        }                
        echo("               </tbody>
                    </table>
                </div>
            </div>");
	
	  
	}
?>
</body>
</html>
