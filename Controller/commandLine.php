<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: commandLine.php	    *
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/
session_start();

$info['command'] = $_POST["command"]; // sent post information
$cmd = $info['command'];


if ($cmd ==1){include 'signUP.php';}				//DONE
elseif($cmd==2){include 'login.php';}				//DONE
elseif($cmd==3){include 'createEvent.php';}			//DONE
elseif($cmd==4){include 'createComment.php';}		//TO-DO
elseif($cmd==5){include 'updateUserBio.php';}		//TO-DO
elseif($cmd==6){include 'updateUserTag.php';}		//DONE
elseif($cmd==7){include 'updateUserFriends.php';}	//TO-DO
elseif($cmd==8){include 'recommendEvents.php';}		//DONE
elseif($cmd==9){include 'displayUserInfo.php';}		//DONE
elseif($cmd==10){include 'displayEvents.php';}		//DONE
elseif($cmd==11){/*include 'displayEventsByTags.php';*/ echo"TO-DO";}
elseif($cmd==12){/*include 'displayEventsByFriends.php';*/ echo"TO-DO";}
elseif($cmd==13){/*include 'cancelledEvents.php';*/ echo"TO-DO";}
elseif($cmd==14){/*include 'displayFriends.php';*/ echo"TO-DO";}
elseif($cmd==15){/*include 'displayFriendsRequests.php';*/ echo"TO-DO";}
elseif($cmd==16){/*include 'sendFriendRequest.php';*/ echo"TO-DO";}
elseif($cmd==17){/*include 'respondToFriendRequest.php';*/ echo"TO-DO";}
elseif($cmd==18){/*include 'deleteFriend.php';*/ echo"TO-DO";}
elseif($cmd==19){/*include 'updateEvent.php';*/ echo"TO-DO";}
elseif($cmd==20){include 'displayTags.php';}
elseif($cmd==21){include 'createTag.php';}
elseif($cmd==22){include 'displayUsers.php';}
elseif($cmd==23){include 'search.php';}
else{echo"Error: 404";}

/****Testing Sign Up
$info['command'] = 1;
$info['firstname'] = 'John';
$info['lastname'] = 'Smith';
$info['username'] = 'test';
$info['password'] = 'test123';
$info['email'] = 'test@njit.edu';
$cmd = 1;


****** Testing recommendations.php
$info['command']= 8;
$info['id'] = 8;
$cmd =8;

****** Testing displayUserInfo.php
$info['command'] = 9;
$info['id'] = 8;
$cmd = 9;

*/
?>
