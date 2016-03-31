<?php
/* author: Totaram Ramrattan
  CS490-104-Semester Project
  2/25/16
*/
function login(){

        // if( $_SESSION['logged_in'] == false ){
                //if login successfull init session
                // else prompt for new user;
                // $user_id=$_POST['username'];
                // $pass=$_POST['password'];
                // $cmd=2;
                // $packet = array( 'command'=> $cmd,'username' => $user_id , 'password' => $pass );
                // $json_packet = json_encode($packet);
                //
                // //TODO remove: set to true for testing
                // $response = 1;
                $info = file_get_contents('php://input');
                $response = authenticate($info);
                echo $response;
            // }
}

function createUser(){
    // $f_name = $_POST['firstname'];
    // $l_name = $_POST['lastname'];
    // $username = $_POST['username'];
    // $email = $_POST['email'];
    // $password = $_POST['password'];
    // $packet = array( 'command'=> 1, 'firstname'=>$f_name, 'lastname'=>$l_name, 'username'=>$username, 'email'=>$email, 'password'=>$password);
    // $json = json_encode($packet);
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


function getData($params){
  //angelica's
  $ch = curl_init("https://web.njit.edu/~aml35/login/commandLine.php");

  //jasper api
  // $ch = curl_init("https://web.njit.edu/~jmd57/backend.php");
  //local test
  // $ch = curl_init("https://web.njit.edu/~tr88/php/test.php");
  // $ch = curl_init("localhost/events/php/server_test.php");
  $headers = curl_getinfo($ch);
  $data = "json=".$params;
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
