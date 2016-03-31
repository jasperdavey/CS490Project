<?php
session_start();
include_once 'functions.php';

$email = $_POST['email'];
$username = $_POST['username'];
$password= $_POST['password'];
$command= $_POST['command'];


  switch ( $command ) {

    case 0:
        break;

    case 1:
        $_SESSION['new_user'] = true;
            createUser();
        break;

    case 2:
        if(isset($email,$password)){
            login();
        }
        break;

    case 3:
        createEvent();
        break;

    case 8:
        getRecommendedEvents();
        break;
    case 'debug':
        echo "debug_php";
        break;

    default:
        # code...
        break;
      }
?>
