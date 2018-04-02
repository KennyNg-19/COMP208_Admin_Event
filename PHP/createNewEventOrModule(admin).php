<?php 
header('Access-Control-Allow-Origin: *');
include 'establishDBCon.php';
	
    
    $programmeName = $_REQUEST["programmeName"];
    $founderName = $_REQUEST["founderName"];
    $eventName = $_REQUEST["eventName"];
    $eventType = $_REQUEST["type"];
    $startTime = $_REQUEST["eventStartTime"];//in 'YYYY-MM-DD HH:MM:SS' format of MySQL
    $endTime = $_REQUEST["eventEndTime"]; //in 'YYYY-MM-DD HH:MM:SS' format of MySQL
	$locationSelection = $_REQUEST["location"]; // 什么格式？ID 的话：那就是取自前端的一个select menu咯？ 因为用户又不知道也不能记忆那么多id
    $briefDescription = $_REQUEST["brief"];
    $pdo = establishDatabaseConnection("localhost","test","root","root");

    //call creation function
    createNewEvent();

    function matchUserInfo($programmeName, $founderName){    
    	//check if user matches the programme
    	$sql = $pdo->query("SELECT programmeID from programme
    						WHERE programmeName = '$programmeName';")
    	$programmeID = $sql['programmeID'];
    	
    	$sql = $pdo->query("SELECT userID from user
    						where programmeID = $programmeID;");
    	$userName = $sql['userName'];
    	
    	if(!($userName == $founderName)){
    		echo "Error, your name fails to match your programme type";
    		return;
    	}else{
    		return true;
    	}
    }

    function createNewEvent(){
    	global $pdo, $programmeName, $founderName, $eventType, $eventName, $startTime, $endTime, $locationSelection, $briefDescription;

    	// past matching test
    	if(matchUserInfo($programmeName, $founderName)){
    		try{
    			$pdo->beginTransaction();

    			$insert = $pdo->prepare("INSERT INTO 
    			event(eventName, founderName, isAcademic, startTime, endTime, popularity, locationID, brief)
    			VALUES (?, ?, ?, ?, ?, ?, ?, ?);")
	    		$insert->exec(array('$eventName','$founderName', $eventType, '$startTime', '$endTime', 0 ,'$locationSelection', '$briefDescription'));

    			$pdo->commit();
    			echo "New Event creation is done."
    		}catch (PDOException $e) {
    			echo "New Event creation fails."
        		$pdo->rollBack();     
    		}
    	}
    }

?>