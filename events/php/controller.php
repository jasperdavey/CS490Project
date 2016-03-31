<?php
session_start();
include_once 'functions.php';

$user_id = $_POST['user_id'];
$password= $_POST['pass'];
$arg= $_POST['arg'];


  switch ( $arg ) {

    case 'login_check':
        break;

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
