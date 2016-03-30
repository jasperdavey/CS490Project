<?php
session_start();
include_once 'login.php';

$user_id = $_POST['user_id'];
$password= $_POST['pass'];
$arg= $_POST['arg'];


switch ( $arg ) {

    case 'login_check':
        if($_SESSION['logged_in'] == false){
          // not logged in return 0
          echo 0;
        }else{
          // logged in return 1
          echo 1;
        }

    case 'login':
        if(isset($user_id,$password)){
            login();
        }
        break;

    case 'sign_up':
          $_SESSION['new_user'] = true;

    case 'debug':
        echo "debug_php";
        break;

    default:
        # code...
        break;
}
?>
