<?php

class Rest {

function getConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "bismiL@hi1";
    $dbname = "restapi";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);

    return $conn;

}

function insertEmployee($empData){ 		
	$empName=$empData["empName"];
	$empAge=$empData["empAge"];
	$empSkills=$empData["empSkills"];
	$empAddress=$empData["empAddress"];		
	$empDesignation=$empData["empDesignation"];
	$empQuery="
		INSERT INTO emp 
		SET name='".$empName."', age='".$empAge."', skills='".$empSkills."', address='".$empAddress."', designation='".$empDesignation."'";
	
    if( mysqli_query($this->getConnection(), $empQuery)) {
		$messgae = "Employee created Successfully.";
		$status = 1;			
	} else {
		$messgae = "Employee creation failed.";
		$status = 0;			
	}
	$empResponse = array(
		'status' => $status,
		'status_message' => $messgae
	);
	header('Content-Type: application/json');
	echo json_encode($empResponse);
}

function getAll() {

	
	$empQuery = "
		SELECT id, name, skills, address, age 
		FROM emp ";	
	$resultData = mysqli_query($this->getConnection(), $empQuery);
	$empData = array();
	while( $empRecord = mysqli_fetch_assoc($resultData) ) {
		$empData[] = $empRecord;
	}
	header('Content-Type: application/json');
    $nested = array("Employee"=>$empData);
	echo json_encode($nested);	

}




}

?>