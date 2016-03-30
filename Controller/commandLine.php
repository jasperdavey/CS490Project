<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: commandLine.php	    *
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/
//session_start();

$packet = $_POST['packet']; // sent post information
$info = json_decode($packet);

/*********TESTING FOR CREATE USER *******************
$info['cmd']= 1;
$info['f_name']="Angelica";
$info['l_name']="Llerena";
$info['email']="testing@njit.edu";
$info['user_id']="test123";
$info['pass']="testing";
$info['major']="CS";
$info['minor']="Math";
$info['level']="senior";
$info['grad_date']="Jan 2017";
$info['g_name']="";
******************************************************/

/*********TESTING FOR CREATEING EVENT ****************
$info['cmd']= 3;
$info['event_title']="ACM-Innovation";
$info['event_host']="CS Department";
$info['event_description']="Pizza will be served";
$info['event_date']="04/04/2016";
$info['event_time']="10:00 AM EASTERN-TIME";
$info['event_location']="GITC 4400";
$info['event_phone']="987-345-6754";
$info['event_email']="event@njit.edu";
******************************************************/

/*********TESTING FOR RECOMMENDING EVENTS*************
$info['cmd']= 8;
$info['user_id']="test123";
******************************************************/

if ($info['cmd']==1){include 'signUP.php';}					//DONE
elseif($info['cmd']==2){include 'login.php';}				//DONE
elseif($info['cmd']==3){include 'createEvent.php';}			//DONE
elseif($info['cmd']==4){include 'createComment.php';}		//FUTURE
elseif($info['cmd']==5){include 'updateUserBio.php';}		//FUTURE
elseif($info['cmd']==6){include 'updateUserTags.php';}		//IDK
elseif($info['cmd']==7){include 'updateUserFriends.php';}	//FUTURE
elseif($info['cmd']==8){include 'recommendations.php';}		//TO-DO
elseif($info['cmd']==9){include 'returnUserInfo.php';}		//TO-DO
else{echo"Error: 404<br>"; /*session_destroy();*/}
?>
