<?php
/********MIDDLE END**********************
Project:  CS 490 - Group # 2		    *
FileName: displayAllFriendsEvents.php	*
By:       Angelica Llerena				*
Date:     March 15, 2016.				*
*****************************************/

//GETTING EVENT_ID 
$info['id'] =$_POST['id'];


//Checking id field is not empty
if (EMPTY($_POST['id'])){
	$data['404'] = "Error: Field was left empty.";
	$json = json_encode($data);
	die($json);
}



//SENDING DATA TO JASPER
$data = json_encode($info);


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
echo $DB_results;

?>