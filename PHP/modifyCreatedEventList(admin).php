<?php

header('Access-Control-Allow-Origin:*');
    include 'establishDBCon.php';

    $userID = $_REQUEST["userID"];
    $eventID = $_REQUEST["eventID"];
    $userInfoPdo = establishDatabaseConnection("localhost","user_info","root","root");
    
// admin delete 他创建的
    function delCreatedEvent(){
        global $userID;
        global $eventID;
        global $userInfoPdo;
        $userInfoPdo->beginTransaction();
        //admin 直接修改event table
        $sql = "DELETE FROM event WHERE eventID = $eventID";
        $userInfoPdo->exec($sql);
        $userInfoPdo->commit();
    }

    function modifyEventName($newEventName){
        global $userID;
        global $eventID;
        global $userInfoPdo;
        $userInfoPdo->beginTransaction();
        $sql = "UPDATE event set eventName = '$newEventName' where eventID = $eventID;";
        $pdo->exec($sql);
        $userInfoPdo->commit();
    }

    function modifyFounderName($newFounderName){        
        global $userID;
        global $eventID;
        global $userInfoPdo;
        $userInfoPdo->beginTransaction();
        $sql = "UPDATE event set founderName = '$newFounderName' where eventID = $eventID;";
        $pdo->exec($sql);
        $userInfoPdo->commit();
    }

    function modifyStartTime($newStartTime){
        global $userID;
        global $eventID;
        global $userInfoPdo;
        $userInfoPdo->beginTransaction();
        $sql = "UPDATE event set startTime = '$newStartTime' where eventID = $eventID;";
        $pdo->exec($sql);
        $userInfoPdo->commit();
    }

    function modifyEndTime($newEndTime){
        global $userID;
        global $eventID;
        global $userInfoPdo;
        $userInfoPdo->beginTransaction();
        $sql = "UPDATE event set endTime = '$newEndTime' where eventID = $eventID;";
        $pdo->exec($sql);
        $userInfoPdo->commit();
    }

    //location ID 是在下拉菜单中
    function modifyEventLocation($newLocationID){
        global $userID;
        global $eventID;
        global $userInfoPdo;
        $userInfoPdo->beginTransaction();
        $sql = "UPDATE event set locationID = $newLocationID where eventID = $eventID;";
        $pdo->exec($sql);
        $userInfoPdo->commit();

    }

    //可否在让js返回原内容，在原基础上修改，动态一点？，感觉brief要改起来，重写的部分很多
    function modifyEventBrief($newBrief){
        global $userID;
        global $eventID;
        global $userInfoPdo;
        $userInfoPdo->beginTransaction();
        $sql = "UPDATE event set locationID = '$newBrief' where eventID = $eventID;";
        $pdo->exec($sql);
        $userInfoPdo->commit();        
    }