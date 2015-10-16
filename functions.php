<?php

	//functions.php
	//ühenduse loomiseks kasuta
	require_once("../configglobal.php");
	$database = "if15_jarmhab";
	
	//Loome uue funktsiooni, et ab'st andmeid
	function getCarData(){
		
	$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
	
	$stmt = $mysqli->prepare("SELECT id, user_id, number_plate, color FROM car_plates WHERE deleted IS NULL");
	$stmt->bind_result($id, $user_id, $number_plate, $color_from_db);
	
	$stmt->execute();
	
	$row = 0;
	
	//tyhi massiiv, kus hoiame objekte (1rida andmeid)
	$array = array();
	
	//tee tsüklit nii mitu korda, kui saad ab'st ühe rea andmeid
	while($stmt->fetch()){
		
		$car = new StdClass();
		$car->id = $id;
		$car->number_plate = $number_plate;
		$car->user_id = $user_id;
		$car->color_from_db = $color_from_db;
		
		
		//lisame selle massiivi
		array_push($array, $car);
		//echo "<pre>";
		//var_dump($array);
		//echo "</pre>";
	}
	//0,1,2,3,4,5
	
	$stmt->close();
	$mysqli->close();
		
		return $array;
	}
	
	function deleteCar($id_to_be_deleted){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("UPDATE car_plates SET deleted=NOW() WHERE id=?");
		$stmt->bind_param("i", $id_to_be_deleted);
		if($stmt->execute()){
			// sai edukalt kustutatud
			header("Location: table.php");
			$stmt->close();
			$mysqli->close();
		
		}
		
	}
	
	
?>