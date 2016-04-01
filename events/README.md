

commands   #code       params     working?

singup  1  command,username,firstname,lastname,password,email  -yes
login   2  command,email,password -yes
createEvent 3 command,name,location,dateAndTime,bio,image
getRecommendedEvents 8 command,id
displayUserInfo 9 command,id
getAllEents 10








if ($cmd ==1){include 'signUP.php';}	//DONE
elseif($cmd==2){include 'login.php';}	//DONE
elseif($cmd==3){include 'createEvent.php';}	//DONE


elseif($cmd==4){include 'createComment.php';}	//TO-DO
elseif($cmd==5){include 'updateUserBio.php';}	//TO-DO
elseif($cmd==6){include 'updateUserTag.php';}	//TO-DO
elseif($cmd==7){include 'updateUserFriends.php';}	//TO-DO

elseif($cmd==8){include 'recommendEvents.php';}	//TO-DO
elseif($cmd==9){include 'displayUserInfo.php';}	//DONE
elseif($cmd==10){include 'displayEvents.php';}	//DONE
