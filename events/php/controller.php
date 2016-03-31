<?php
session_start();
include_once 'functions.php';

$email = $_POST['email'];
$username = $_POST['username'];
$password= $_POST['password'];
$command= $_POST['command'];


  switch ( $command ) {

    case 0:
        loggedInCheck();
        break;

    case 1: // create user
        $_SESSION['new_user'] = true;
            createUser();
        break;

    case 2: // login
        if(isset($email,$password)){
            login();
        }
        break;

    case 3: // create event
        createEvent();
        break;

    case 4: // create comment
        break;

    case 5: // update user bio
        break;
    case 6: //upate user tag_selection
        break;
    case 7: // update friends
        break;

    case 8: // get recommended events
        // getRecommendedEvents();
        break;

    case 9: // return all user info
        break;
    case 'debug':
        echo "debug_php";
        break;
    default:
        break;

      }
?>
