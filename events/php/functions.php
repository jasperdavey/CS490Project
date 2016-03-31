<?php
/* author: Totaram Ramrattan
  CS490-104-Semester Project
  2/25/16
  form_login.php
*/
function login(){

        if( $_SESSION['logged_in'] == false ){
                //if login successfull init session
                // else prompt for new user;
                $user_id=$_POST['user_id'];
                $pass=$_POST['pass'];
                $cmd=2;
                $packet = array( 'command'=> $cmd,'username' => $user_id , 'password' => $pass );
                $json_packet = json_encode($packet);

                $response = authenticate($json_packet);
                echo $response;

        }else{
                echo "failed";
        }
}

function createUser(){


}

function authenticate($params){
      return getData($params);
}


function getData($params){
  //angelica's
  // $ch = curl_init("https://web.njit.edu/~aml35/CS490/commandLine.php");
  //my test php
  //jasper api
  // $ch = curl_init("https://web.njit.edu/~jmd57/backend.php");
  // $ch = curl_init("https://web.njit.edu/~tr88/php/test.php");
  $ch = curl_init("localhost/events/php/server_test.php");
  $headers = curl_getinfo($ch);
  $data = "json=".$params;
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}
?>
