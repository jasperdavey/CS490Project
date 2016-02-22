<?php

//Getting results from Jasper
$resultsDB = file_get_contents('php://input'); //echo $request;

//Reporting back to Devin
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "###"); //Devin's web
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $resultsDB);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    
$exec = curl_exec($ch);
curl_close($ch);  
?>

 
