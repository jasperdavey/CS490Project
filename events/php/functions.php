<?php
/* author: Totaram Ramrattan
  CS490-104-Semester Project
  2/25/16
*/

function login(){
    $info = file_get_contents('php://input');
    $response = authenticate($info);
    $jsonObject = json_decode($response,true);
    $status = $jsonObject["status"];
    if( $status == 200 ){
        $_SESSION['logged_in']=true;
        $_SESSION['id']=$jsonObject['id'];
    }else{
        $_SESSION['logged_in']=false;
        $_SESSION['id']=null;
    }
    echo $status;
}

function logOut(){
    $_SESSION['logged_in']=false;
    if( $_SESSION['logged_in']== false){
      echo 200;
    }else{
      echo 404;
    }
}


function loggedInCheck(){
    /*
    if($_SESSION['logged_in'] == true ){
        echo '200';
    }else{
        echo '404';
    }
    */
    //TODO set back to check
    echo '200';
}

function createUser(){
    $info = file_get_contents('php://input');
    $response = getData($info);
    $data = json_decode($response,true);
    if( $data['status'] == 200 ){
      $_SESSION['id']=$data['id'];
      $_SESSION['logged_in'] = true;
    }
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
    if($_SESSION['id'] != null ){
      $response = getData($info."&id=".$_SESSION['id']);
      echo $response;
    }else{
      echo "failed to get recommended events";
    }
}

function getAllEvents(){

}


function getUserInfo(){
  $info = file_get_contents ('php://input');

  if ( $_SESSION[id] != null ){
    $response = getData($info."&id=".$_SESSION['id']);
    echo $response;
  }else{
    echo "can't get user info";
  }
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
