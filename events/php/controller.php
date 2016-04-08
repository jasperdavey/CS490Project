<?php
session_start();
include_once 'functions.php';

$command= $_POST['command'];

echo $_FILES['image'].name;


  // switch ( $command ) {
  //
  //   case -1:
  //       logOut();
  //         break;
  //
  //   case 0:
  //       loggedInCheck();
  //       break;
  //
  //   case 0.1: // init new user
  //       $_SESSION['new_user'] = true;
  //       $_SESSION['firstname'] = $_POST['firstname'];
  //       $_SESSION['lastname'] = $_POST['lastname'];
  //       $_SESSION['organization'] = $_POST['organization'];
  //       $_SESSION['username'] = $_POST['username'];
  //       $_SESSION['email'] = $_POST['email'];
  //       $_SESSION['password'] = $_POST['password'];
  //       break;
  //
  //   case 1: // create user
  //
  //       if( isset($_SESSION['organization']) ){
  //           // createOrgAccount();
  //       }else{
  //           // createUser();
  //       }
  //       break;
  //
  //   case 2: // login
  //       if(isset($_POST['email'],$_POST['password'])){
  //           login();
  //       }
  //       break;
  //
  //   case 3: // create event
  //       echo 'test';
  //       // createEvent();
  //       break;
  //
  //   case 4: // create comment
  //       break;
  //
  //   case 5: // update user bio
  //       break;
  //   case 6: //upate user tag_selection
  //       break;
  //   case 7: // update friends
  //       break;
  //
  //   case 8: // get recommended events
  //       getRecommendedEvents();
  //       break;
  //
  //   case 9: // return all user info
  //       getUserInfo();
  //       break;
  //   case 'debug':
  //       echo "debug_php";
  //       break;
  //   case 20:
  //       getTags();
  //       break;
  //   default:
  //       echo "command found found";
  //       break;
  //
  //     }
?>
