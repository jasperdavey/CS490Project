<?php
/* author: Totaram Ramrattan
  CS490-104-Semester Project
  2/25/16
  form_login.php
*/

function login(){

$info = file_get_contents('php://input');
session_start();
$user = $_POST["ucid"];
$pass = $_POST["pass"];

$ch = curl_init("https://web.njit.edu/~aml35/login/login.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);

curl_close($ch);
// splits result into two response 1: NJIT-Server 2: project database
list($response1,$response2) = split(" ",$result,2);

echo "</br>";

// decodes json
$response1 = json_decode($response1,true);
$response2 = json_decode($response2,true);

// gets status from json object
$status1 = $response1[status];
$status2 = $response2[status];

// handles njit server cases
echo '<p><span style="font-weight:bold;">NJIT Server: </span>';
if ($status1 == "failed"){
  echo "failed to login, incorrect username or password!"."</p>";
}else{
  echo "successfully logged in!"."</p>";
}

echo '<p><span style="font-weight:bold;">Project Database: </span>';

// handles cases for project database connection
switch($status2){
  case 304:
    echo "incorrect password!"."</p></br>";
    break;
  case 404:
    echo "user not found!"."</p></br>";
    break;
  case 200:
    echo "successfully logged in!"."</p></br>";
    break;
}

}

?>
