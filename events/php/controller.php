<?php
session_start();
include_once 'functions.php';

$command= $_POST['command'];
$params = buildParams();

  switch ( $command ) {

    case -1:
        logOut();
          break;

    case 0:
        loggedInCheck();
        break;

    case .1: // create user
        $_SESSION['new_user'] = true;
        $_SESSION['firstname'] = $_POST['firstname'];
        $_SESSION['lastname'] = $_POST['lastname'];
        $_SESSION['organization'] = $_POST['organization'];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        echo 200;
        break;
    case 2:
        if( isset($_SESSION['organization']) ){
            // createOrgAccount();
            $params = $params.'&username='.$_SESSION['organization'].'&email='.$_SESSION['email'].'&password='.$_SESSION['password'];
            echo $params;
        }else{
            $params = $params.'&firstname='.$_SESSION['firstname'].'&lastname='.$_SESSION['lastname'].
            '&username='.$_SESSION['username'].'&email='.$_SESSION['email'].'&password='.$_SESSION['password'];
            echo $params;
            // createUser($params);
        }
        break;

    case 2: // login
        if(isset($_POST['email'],$_POST['password'])){
            login($params);
        }
        break;

    case 3: // create event
        echo 'test';
        // createEvent();
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
        getRecommendedEvents($params);
        break;

    case 9: // return all user info
        getUserInfo($params);
        break;
    case 'debug':
        echo "debug_php";
        break;
    case 20:
        getTags();
        break;
    default:
        echo "command found found";
        break;

      }
?>
