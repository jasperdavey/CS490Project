<?php
session_start();
$ch = curl_init("https://web.njit.edu/~aml35/test/testing.php");
$info = file_get_contents('php://input');

$hello = "info";
$hi = "hello";
$params = "arg=$hello";

if($_POST['arg']){
    $headers = curl_getinfo($ch);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
}else{
    echo "other: ";
    echo $_POST['user_id'];
    echo ", ";
    echo $_POST['pass'];
    echo "<br>";
    $headers = curl_getinfo($ch);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
}




?>
