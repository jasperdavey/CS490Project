<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: updateUserTag.php	*
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/

$info['id']=$_POST['id'];
$info['tag']=$_POST['tag'];

$data=json_encode($info);
//echo $data;
$J_url = "https://web.njit.edu/~jmd57/backend.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $J_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "json=".$data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//This is what I want from Jasper
$DB_results= curl_exec($ch);
curl_close($ch);

$json = json_decode($DB_results,true);

echo $DB_results;

?>