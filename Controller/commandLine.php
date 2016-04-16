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

//CONSENT
if ($cmd ==1){include 'signUP.php';}				//DONE
elseif($cmd==2){include 'login.php';}				//DONE
elseif($cmd==15){include 'acceptFriendRequest.php';} //need testing 
//elseif($cmd==##){include 'rejectFriendRequest.php';} //need testing 



//CREATE...
elseif($cmd==3){include 'createEvent.php';}			//DONE
elseif($cmd==4){include 'createComment.php';}		//TO-DO....
elseif($cmd==7){include 'createFriendRequest.php';}	//need testing 

//UPDATES...
//elseif($cmd==##){include 'updateEventBio.php';}		//need testing
//elseif($cmd==##){include 'updateEventEndDateTime.php';}		//need testing
//elseif($cmd==##){include 'updateEventLocation.php';}		//need testing
//elseif($cmd==##){include 'updateEventName.php';}		//need testing
//elseif($cmd==##){include 'updateEventStartDateTime.php';}		//need testing
elseif($cmd==5){include 'updateUserBio.php';}		//need testing
//elseif($cmd==##){include 'updateUserEmail.php';}		//need testing
//elseif($cmd==##){include 'updateUserFirstname.php';}		//need testing
//elseif($cmd==##){include 'updateUserLastname.php';}		//need testing
//elseif($cmd==##){include 'updateUserPassword';}		//need testing
elseif($cmd==6){include 'updateUserTag.php';}		//need testing
//elseif($cmd==##){include 'updateUserUsername.php';}		//need testing




//REMOVE....
elseif($cmd==14){include 'removeUserTag.php';}		//need testing
//elseif($cmd==##){include 'removeEventTag.php';}		//need testing
//elseif($cmd==##){include 'removeUserEvent.php';}		//need testing
//elseif($cmd==##){include 'removeUserFriend.php';}		//need testing



//RETURN...
elseif($cmd==8){include 'recommendEvents.php';}		//DONE
elseif($cmd==9){include 'displayUserInfo.php';}		//DONE
elseif($cmd==16){include 'displayUsers.php';}		//DONE


//MIDDLE - ONLY
elseif($cmd==11){include 'displayTags.php';}		//DONE
elseif($cmd==12){include 'search.php';}				//DONE
elseif($cmd==13){include 'futureEventsWithFriends.php';}	//DONE
elseif($cmd==24){include 'displayEvents.php';}		//DONE
elseif($cmd==25){include 'futureEvents.php';}		//DONE
elseif($cmd==26){include 'userPastEvents.php';}		//TO-DO...
else{echo"Error: 404";}

?>
