<?php
/* author: Totaram Ramrattan
  CS490-104-Semester Project
  2/25/16
*/

function login(){
    $info = file_get_contents('php://input');
    $response = authenticate($info);
    if( $response == 200 ){
        $_SESSION['logged_in']=true;
    }else{
        $_SESSION['logged_in']=false;
    }
    echo $response;
}


function loggedInCheck(){
    if($_SESSION['logged_in'] == true ){
        echo '200';
    }else{
        echo '404';
    }
}

function createUser(){
    $info = file_get_contents('php://input');
    $response = getData($info);
    echo $response;
}

function createEvent(){
    $info = file_get_contents('php://input');
    $response = getData($info);
    echo $response;
}

function authenticate($params){
      return getData($params);
}

function getRecommendedEvents(){
    $info = file_get_contents('php://input');
    $response = getData($info);
    echo $response;
}


function getUserInfo(){
  $info = file_get_contents ('php://input');
  $response = getData($info);
  echo $response;
}

function getData($params){
  //angelica's
  $ch = curl_init("https://web.njit.edu/~aml35/login/commandLine.php");
  //jasper api
  // $ch = curl_init("https://web.njit.edu/~jmd57/backend.php");
  //local test
  // $ch = curl_init("https://web.njit.edu/~tr88/php/test.php");
  // $ch = curl_init("localhost/events/php/server_test.php");
  $headers = curl_getinfo($ch);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
  echo $result;
}
?>
