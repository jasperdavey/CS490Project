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
elseif($cmd==4){include 'createComment.php';}		//TO-DO....
elseif($cmd==5){include 'updateUserBio.php';}		//TO-DO....
elseif($cmd==6){include 'updateUserTag.php';}		//DONE
elseif($cmd==7){include 'updateUserFriends.php';}	//TO-DO....
elseif($cmd==8){include 'recommendEvents.php';}		//DONE
elseif($cmd==9){include 'displayUserInfo.php';}		//DONE
elseif($cmd==10){include 'displayEvents.php';}		//DONE
elseif($cmd==11){include 'futureEvents.php';}		//DONE
elseif($cmd==12){include 'futureEventsWithFriends.php';} //needs to be tested
elseif($cmd==13){include 'userPastEvents.php';}	//DONE
elseif($cmd==14){echo"TO-DO";}
elseif($cmd==15){echo"TO-DO";}
elseif($cmd==16){echo"TO-DO";}
elseif($cmd==17){echo"TO-DO";}
elseif($cmd==18){echo"TO-DO";}
elseif($cmd==19){echo"TO-DO";}
elseif($cmd==20){include 'displayTags.php';}
elseif($cmd==21){echo"TO-DO";}
elseif($cmd==22){include 'displayUsers.php';}
elseif($cmd==23){include 'search.php';}
else{echo"Error: 404";}


?>
