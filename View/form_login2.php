<?php
header("Access-Control-Allow-Origin: *");
/* author: Totaram Ramrattan
  CS490-104-Semester Project
  2/25/16
  form_login.php
*/

$info = file_get_contents('php://input');
session_start();
$user = $_POST["ucid"];
$pass = $_POST["pass"];

$ch = curl_init("https://web.njit.edu/~aml35/login/login.php");
$headers = curl_getinfo($ch);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

echo $result;

?>
