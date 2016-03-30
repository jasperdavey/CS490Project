<?php
/* author: Totaram Ramrattan
  CS490-104-Semester Project
  2/25/16
  form_login.php
*/
session_start();

function login(){
        if( $_SESSION['logged_in'] == false ){
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $_POST['user_id'];
                $_SESSION['password'] = $_POST['pass'];
                echo "1";
            // authenticate($user_id,$password);
        }else{
                echo $_SESSION['user_id'];
        }
}

function authenticate($user_id, $password){
    $params = "ucid=".$user_id."&pass=".$password;
    $ch = curl_init("https://web.njit.edu/~aml35/login/login.php");
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
