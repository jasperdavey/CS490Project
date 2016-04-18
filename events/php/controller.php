<?php
session_start();

$debug = false;
include_once 'functions.php';

$command = null;

if( isset($_POST['command'])){
    $command = $_POST['command'];
}else{
  echo "no command give : ending...";
  return;
}

myLog("\nnew log ---------------------------------\n",true);
$params = buildParams();
//set up testing output file
//clear log file

  switch ( $command ) {

    case -1:
        myLog("case -1: logOut():params: ".$params);
        logOut();
          break;

    case 0:
        myLog("login check called: ",true);
        loggedInCheck();
        break;

    case 0.1: // create user
        myLog("case 0.1- create new user, params:".$params,false);
        $_SESSION['new_user'] = true;
        if( isset($_POST['firstname'],$_POST['lastname'],$_POST['username'])){
          $_SESSION['firstname'] = $_POST['firstname'];
          $_SESSION['lastname'] = $_POST['lastname'];
          $_SESSION['username'] = $_POST['username'];
        }
        if(isset($_POST['organization'])){
          $_SESSION['organization'] = $_POST['organization'];
        }
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        echo 200;
        break;
    case 1:

        myLog("new user sign up,params: ".$params,false);
        if( isset($_SESSION['organization']) ){
            $params = $params.'&username='.$_SESSION['organization'].'&email='.$_SESSION['email'].'&password='.$_SESSION['password'];
            myLog("case 1-creating organization:\n".$params,false);
            //TODO remove test case
            echo makeRequest($params);
            break;
        }else{
            $params = $params.'&firstname='.$_SESSION['firstname'].'&lastname='.$_SESSION['lastname'].
            '&username='.$_SESSION['username'].'&email='.$_SESSION['email'].'&password='.$_SESSION['password'];
            myLog("case 1-creating single user:\n".$params,false);
            //TODO remove test
            echo makeRequest($params);
            break;
        }

        break;

    case 2: // login
        myLog("case 2 -executing login(), params: ".$params,false);
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
        myLog("case 8-get recommended events, params:".$params,false);
        getRecommendedEvents($params);
        break;

    case 9: // return all user info
        getUserInfo($params);
        break;
    case 11:
        myLog("case 11 - get all tags called,params: ".$params,false);
        echo makeRequest($params);
        break;
    case 25:
        myLog("case 25- get all future events,parms:".$params,false);
        echo makeRequest($params);
        break;
    case 'debug':
        echo "debug_php";
        break;
    default:
        echo '{"status":"command not regonized"}';
        break;

      }
?>
