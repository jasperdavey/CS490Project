<?php
/********MIDDLE END**************************
Project:  CS 490 - Group # 2    			*
FileName: updadteEventStartDateTime.php    	*
By:       Angelica Llerena					*
Date:     April 10, 2016.					*
*********************************************/

//Input: initiatorID, targetID
//Output: DB_results


$info['startDateTime'] = $_POST['startDateTime'];
$info['id']= $_POST['id'];



	
	$data = json_encode($info);
	
	//Sending to Jasper's url...
	$J_url = "https://web.njit.edu/~jmd57/backend.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $J_url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "json=".$data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$DB_results = curl_exec($ch);
	curl_close($ch);

die($DB_results);
?>