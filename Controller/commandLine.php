<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: commandLine.php	    *
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/

/*
1. SignUp.php
2. login.php
3. createEvent.php
4. createComment.php   *****************************later
5. updateUserBio.php
6. updateUserTag.php
7. createFriendRequest.php
8. recommendEvents.php
9. displayUserInfo.php
10. updateUserEvent.php
11. displayTags.php
12. search.php  (mine)
13. futureEventsWithFriends.php
14. removeUserTag.php
15. acceptFriendRequest.php
16. displayUsers.php
17. updateEventTags.php
18. removeEventTag.php
19. updateUserUsername.php
20. removeUserEvent.php
21. updateUserPassword.php
22. updateUserFirstname.php
23. updateUserLastname.php
24. updateUserEmail.php
25. updateEventStartDateTime.php
26. updateEventEndDateTime.php
27. updateEventName.php
28. updateEventLocation.php
29. updateEventBio.php 
30. displayPastEvents.php (to-do)
31. displayFutureEvents.php (to-do)
32. displayEventInfo.php (to-do)
33. displayEvents.php
34. displayUserFriend.php (to-do)
35. rejectFriendRequest.php
*/

$info['command'] = $_POST["command"]; // sent post information
$cmd = $info['command'];
//echo $cmd;
//echo "Welcome to Controller";
if ($cmd ==1){include 'signUP.php';}				//DONE
elseif($cmd==2){include 'login.php';}				//DONE
elseif($cmd==3){include 'createEvent.php';}			//DONE
elseif($cmd==4){include 'createComment.php';}		//DONE
elseif($cmd==5){include 'updateUserBio.php';}		//DONE  5
elseif($cmd==6){include 'updateUserTag.php';}		//DONE	6
elseif($cmd==7){
	//include 'sendFriendRequest.php';
	$info['initiatorID'] = $_POST['initiatorID'];
	$info['targetID']= $_POST['targetID'];

	
	$data = json_encode($info);
	//echo $data;
	//Sending to Jasper's url...
	$J_url = "https://web.njit.edu/~jmd57/backend.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $J_url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "json=".$data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$DB_results = curl_exec($ch);
	curl_close($ch);
	
	die($DB_results);
	
}  
elseif($cmd==8){include 'recommendEvents.php';}		//DONE  
elseif($cmd==9){include 'displayUserInfo.php';}		//DONE		
elseif($cmd==10){include 'updateUserEvent.php';}	//DONE
elseif($cmd==11){include 'displayTags.php';}		//DONE
elseif($cmd==12){include 'search.php';}				//DONE   
elseif($cmd==13){include 'displayAllFriendsEvents.php';}
elseif($cmd==14){include 'removeUserTag.php';}		//done
elseif($cmd==15){
	//include 'acceptFriendRequest.php';
	$info['initiatorID'] = $_POST['initiatorID'];
	$info['targetID']= $_POST['targetID'];

	
	$data = json_encode($info);
	//echo $data;
	//Sending to Jasper's url...
	$J_url = "https://web.njit.edu/~jmd57/backend.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $J_url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "json=".$data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$DB_results = curl_exec($ch);
	curl_close($ch);

	die($DB_results);
} //done
elseif($cmd==16){include 'returnUsers.php';}		//DONE
elseif($cmd==17){include 'updateEventTag.php';}		//DONE
elseif($cmd==18){include 'removeEventTag.php';}		//DONE
elseif($cmd==19){include 'updateUserUsername.php';}		//DONE  19
elseif($cmd==20){include 'removeUserEvent.php';}		//done
elseif($cmd==21){include 'updateUserPassword.php';}		//DONE
elseif($cmd==22){include 'updateUserFirstname.php';}		//DONE  22
elseif($cmd==23){include 'updateUserLastname.php';}		//DONE  23
elseif($cmd==24){include 'updateUserEmail.php';}		//DONE  24
elseif($cmd==25){include 'updateEventStartDateTime.php';}		//DONE  25
elseif($cmd==26){include 'updateEventEndDateTime.php';}		//DONE  26
elseif($cmd==27){include 'updateEventName.php';}		//DONE
elseif($cmd==28){include 'updateEventLocation.php';}		//DONE
elseif($cmd==29){include 'updateEventBio.php';}		//DONE 
elseif($cmd==30){include 'displayPastEvents.php';}
elseif($cmd==31){include 'displayFutureEvents.php';}		//DONE
elseif($cmd==32){include 'displayEventInfo.php';}
elseif($cmd==33){include 'returnEvents.php';}		//DONE
elseif($cmd==34){include 'displayUserFriend.php';}		//DONE.....
elseif($cmd==35){
	//include 'rejectFriendRequest.php';
	$info['initiatorID'] = $_POST['initiatorID'];
	$info['targetID']= $_POST['targetID'];

	
	$data = json_encode($info);
	//echo $data;
	//Sending to Jasper's url...
	$J_url = "https://web.njit.edu/~jmd57/backend.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $J_url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "json=".$data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$DB_results = curl_exec($ch);
	curl_close($ch);

	die($DB_results);
}   
elseif($cmd==36){include 'removeUserFriend.php';}
elseif($cmd==37){include 'deleteUser.php';}
elseif($cmd==38){include 'deleteEvent.php';}
elseif($cmd==39){include 'updateComment.php';}
elseif($cmd==40){include 'displayComment.php';}
elseif($cmd==41){include 'deleteComment.php';}
else{echo"Error: 404 - Controler is not getting the command";}

?>