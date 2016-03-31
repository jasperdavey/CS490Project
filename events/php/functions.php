<?php
/* author: Totaram Ramrattan
  CS490-104-Semester Project
  2/25/16
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

                //TODO remove: set to true for testing
                $response = 1;
                //$response = authenticate($json_packet);
                echo $response;

        }else{
                echo "failed";
        }
}

function createUser(){
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $packet = array( 'command'=> 1, 'firstname'=>$f_name, 'lastname'=>$l_name, 'username'=>$username, 'email'=>$email, 'password'=>$password);
    $json = json_encode($packet);
    $response = getData($json);
    echo $response;
}

function authenticate($params){
      return getData($params);
}


function getData($params){
  //angelica's
  $ch = curl_init("https://web.njit.edu/~aml35/CS490/commandLine.php");

  //jasper api
  // $ch = curl_init("https://web.njit.edu/~jmd57/backend.php");

  //local test
  // $ch = curl_init("https://web.njit.edu/~tr88/php/test.php");
  // $ch = curl_init("localhost/events/php/server_test.php");
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
