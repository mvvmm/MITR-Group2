<?php
include_once "db_connector.php";
// if(isset($_POST['employee']) && $_POST['project'] && $_POST['workDate']) {
if(isset($_POST['employee']) && $_POST['workDate']) {
	$uid=$_POST['employee'];
	// $pid=$_POST['project'];

	$workDate = $_POST['workDate']." 00:00:00";
    $workDateTime = DateTime::createFromFormat('m/d/Y g:i:s', $workDate);
    $workDateTime = $workDateTime->format('Y-m-d H:i:s');

	
	$conn = dbConnect();
	$stmt = $conn->prepare('SELECT * FROM users where uid=:uid');
    $stmt->bindParam(':uid',$uid);
    $stmt->execute();
    $query = $stmt->fetch();
    
    $employee = $query["firstname"]." ". $query["lastname"];
    $stmt = $conn->prepare('SELECT * FROM timesheet where uid=:uid');
    $stmt->bindParam(':uid',$uid);
    
    $stmt->execute();
    $query = $stmt->fetchAll();

    $labor_hours=0;

    $day = DateTime::createFromFormat("Y-m-d H:i:s", $workDateTime)->format("m/d/Y");
    foreach($query as $value){
    	
    	$q_day = DateTime::createFromFormat("Y-m-d H:i:s", $value["starttime"])->format("m/d/Y");
    	
    	
    	if($q_day == $day && $value["endtime"]!=""){
    		$starttime = strtotime(DateTime::createFromFormat("Y-m-d H:i:s", $value["starttime"])->format("H:i"));
    		$endtime=strtotime(DateTime::createFromFormat("Y-m-d H:i:s", $value["endtime"])->format("H:i"));
    		$hours = ($endtime-$starttime)/3600;
    		$labor_hours+=$hours;
    	}
    }
    echo($employee." ");
    echo($labor_hours." ");
    echo($day." ");


}

?>