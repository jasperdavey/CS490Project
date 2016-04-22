<?php
/*
** Totaram Ramrattan
** CS 490 Project - Front END
*/

session_start();

$debug = false;
$linux = true;

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
        myLog("case -1: logOut():params: ".$params,false);
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
          myLog("setting - firstname,lastname,username",false);
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
    case 1: // sign up

        myLog("new user sign up,params: ".$params,false);

        // organization
        if( isset($_SESSION['organization']) ){
            myLog("creating organization user",false);
            $params = $params.'&username='.$_SESSION['organization'].'&email='.$_SESSION['email'].'&password='.$_SESSION['password'];
            myLog("case 1-creating organization:\n".$params,false);
            //parse json and store user id
            $response = makeRequest($params);
            $jsonObject = json_decode($response,true);

            if( $jsonObject['status'] == 200 ){
              $_SESSION['id'] = $jsonObject['id'];
              $_SESSION['logged_in'] = true;
            }else{
              //kill session
              session_unset();
              session_destroy();
              $_SESSION['logged_in']=false;
            }

            echo $response;
            break;
        }else{ // single user
            myLog("creating single user",false);
            $params = $params.'&firstname='.$_SESSION['firstname'].'&lastname='.$_SESSION['lastname'].
            '&username='.$_SESSION['username'].'&email='.$_SESSION['email'].'&password='.$_SESSION['password'];
            myLog("case 1-creating single user:\n".$params,false);
            //TODO remove test
            $response = makeRequest($params);
            $jsonObject = json_decode($response,true);
            if( $jsonObject['status'] == 200 ){
              $_SESSION['id'] = $jsonObject['id'];
              $_SESSION['logged_in'] = true;
            }else{
              //kill session
              session_unset();
              session_destroy();
              $_SESSION['logged_in']=false;
            }
            echo $response;
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
        echo createEvent($params);
        break;

    case 4: // create comment
        break;

    case 5: // update user bio
        break;
    case 6: //upate user tag_selection
        break;
    case 7: // make friend request
        echo makeRequest($params);
        break;

    case 8: // get recommended events
        myLog("case 8-get recommended events, params:".$params,false);
        echo getRecommendedEvents($params);
        break;

    case 9: // return single user info
        echo getThisUserInfo($params);
        break;

    case 10:
        myLog("case 10 - registering for event: ".$params,false);
        echo makeRequest($params);
        break;

    case 11: // get all tags
        myLog("case 11 - get all tags called,params: ".$params,false);
        echo makeRequest($params);
        break;

    case 12: //search
        myLog("case 12 - making a search request: ".$params,false);
        echo makeRequest($params);
        break;
    case 13: // get all friends events
        myLog("case 13 - getting all friends events".$params,false);
        echo makeRequest($params);
        break;
    case 15: // accept friend request
        echo makeRequest($params);
        break;

    case 16: // return all users
        myLog("case 16 - getting all users request: ".$params,false);
        echo makeRequest($params);
        break;

    case 20:// unregisted for event
        myLog("case 20 - unregister for event: ".$params,false);
        echo makeRequest($params);
        break;

    case 31: // get all future events
        myLog("case 31- get all future events,parms:".$params,false);
        echo getFutureEvents($params);
        break;

    case 32: // get events info
        myLog("case 32- get multiple events,parms:".$params,false);
        if( isset($_POST['event_ids'])){
          $events = json_decode($_POST['event_ids'],true);
          $events = $events['ids'];
          echo getEvents($events);
        }else{
          echo '{"events":[]}';
        }
        break;

    case 35: // reject friend requests
      myLog("case 35- reject friend request,parms:".$params,false);
      echo makeRequest($params);
      break;

    case 36: // remove friends
        myLog("case 36- remove friend,parms:".$params,false);
        echo makeRequest($params);
        break;
    case 40: //returns multiple user info
        echo getUsersInfo();
        break;

    case 'debug':
        echo "debug_php";
        break;

    default:
        echo 'internal error: command not found';
        break;

      }
?>
