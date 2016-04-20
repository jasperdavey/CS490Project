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



session_start();

$info['command'] = $_POST["command"]; // sent post information
$cmd = $info['command'];


if ($cmd ==1){include 'signUP.php';}				//DONE
elseif($cmd==2){include 'login.php';}				//DONE
//elseif($cmd==15){include 'acceptFriendRequest.php';} //working on 
//elseif($cmd==##){include 'rejectFriendRequest.php';} //working on  



//CREATE...
elseif($cmd==3){include 'createEvent.php';}			//DONE
//elseif($cmd==4){include 'createComment.php';}		//TO-DO....
elseif($cmd==7){include 'createFriendRequest.php';}	//DONE   7

//UPDATES...
elseif($cmd==27){include 'updateEventBio.php';}		//DONE 
elseif($cmd==28){include 'updateEventEndDateTime.php';}		//DONE  26
elseif($cmd==29){include 'updateEventLocation.php';}		//DONE
elseif($cmd==22){include 'updateEventName.php';}		//DONE
elseif($cmd==23){include 'updateEventStartDateTime.php';}		//DONE  25
elseif($cmd==5){include 'updateUserBio.php';}		//DONE  5
elseif($cmd==21){include 'updateUserEmail.php';}		//DONE  24
elseif($cmd==17){include 'updateUserFirstname.php';}		//DONE  22
elseif($cmd==18){include 'updateUserLastname.php';}		//DONE  23
elseif($cmd==21){include 'updateUserPassword.php';}		//DONE
elseif($cmd==6){include 'updateUserTag.php';}		//DONE	6
elseif($cmd==19){include 'updateUserUsername.php';}		//DONE  19

// updateUserEvent.php 10
// updateEventTags.php 17


//REMOVE....
elseif($cmd==14){include 'removeUserTag.php';}		//done
elseif($cmd==18){include 'removeEventTag.php';}		//need testing
elseif($cmd==20){include 'removeUserEvent.php';}		//need testing
//elseif($cmd==##){include 'removeUserFriend.php';}		//working on 



//RETURN...
elseif($cmd==8){include 'recommendEvents.php';}		//DONE  
elseif($cmd==9){include 'displayUserInfo.php';}		//DONE		
elseif($cmd==16){include 'displayUsers.php';}		//DONE
elseif($cmd==30){include 'displayPastEvents.php';}
elseif($cmd==31){include 'displayFutureEvents.php';}
elseif($cmd==32){include 'displayEventInfo.php';}
elseif($cmd==13){include 'displayAllFriendsEvents.php';}


//MIDDLE - ONLY
elseif($cmd==11){include 'displayTags.php';}		//DONE
elseif($cmd==12){include 'search.php';}				//DONE   12
elseif($cmd==24){include 'displayEvents.php';}		//DONE
elseif($cmd==25){include 'futureEvents.php';}		//DONE
//elseif($cmd==26){include 'userPastEvents.php';}		//TO-DO...
else{echo"Error: 404";}

?>