<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: commandLine.php	      *
By:       Angelica Llerena		  *
Date:     March 15, 2016.		    *
*********************************/
session_start();

$info['command'] = $_POST['command']; // sent post information
$cmd = $info['command'];


if ($cmd ==1){include 'signUP.php';}				      //DONE
elseif($cmd==2){include 'login.php';}				      //DONE
elseif($cmd==3){include 'createEvent.php';}			  //DONE
elseif($cmd==4){include 'createComment.php';}		  //TO-DO
elseif($cmd==5){include 'updateUserBio.php';}		  //TO-DO
elseif($cmd==6){include 'updateUserTags.php';}		//TO-DO
elseif($cmd==7){include 'updateUserFriends.php';}	//TO-DO
elseif($cmd==8){include 'recommendEvents.php';}		//TO-DO
elseif($cmd==9){include 'displayUserInfo.php';}		//DONE
elseif($cmd==10){include 'displayEvents.php';}		//DONE
else{echo"Error: 404";}
?>
