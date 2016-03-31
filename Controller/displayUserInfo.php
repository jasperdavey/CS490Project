<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: displayUserInfo.php	    *
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/

$info['username'] = $_POST['username'];

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

$json = json_decode($DB_results,true);

if($json['status']==200){
	//echo $json['status'];
	print_r($json['info']);
}else{
	echo $json['status'];
}

?>
