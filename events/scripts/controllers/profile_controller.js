

// close profile view
function closeProfileView( node ){
  node.style.visibility="collapse";
  document.getElementById('friends_view_container_body').innerHTML="";
}

function showProfileView(){
  document.getElementById('profile_container').style.visibility = 'visible';

  //init HashTagHanlder
  var tagHandler = new HashTagHanlder('profile_selected_tags',null);
  if(USER_INFO != null){
      var tags = USER_INFO.tags;
      document.getElementById('profile_selected_tags').innerHTML="";

      //load user tags into HashTagHanlder
      tagHandler.loadUserTags(tags);
      tagHandler.displayHashTags();
  }else{
    console.log('failed to get user tags:response-'+response);
  }
  //load friends
  getAllFriends('friends_view_container_body');
  loadRecievedFR('request_view_container_body');
  //hide dash menu if open close it'
  if(  document.getElementById('dashboard_menu').style.visibility == 'visible'){
    showDashMenu();
  }
}

/************************** manage friends ************************************/

function makeFriendRequest(targetID){
  var formData = new FormData();
  formData.append('command',SEND_FRIEND_REQUEST_);
  formData.append('initiatorID',USER_INFO.id);
  formData.append('targetID',targetID);

  try{
      var response = makeRequest(formData);
      response = JSON.parse(response);
      status = response.status;
      if(status == 200 ){
        alert('friend request sent');
      }else{
        alert('failed to initiate friend request');
      }
  }catch(e){
    console.log('friend request failed');
    console.log(e);
  }

}

function acceptFriendRequest(initiatorID,node){
  console.log('accepting friend request, id:'+initiatorID);
  var formData = new FormData();
  formData.append('command',ACCEPT_REQUEST_);
  formData.append('initiatorID',USER_INFO.id);
  formData.append('targetID',initiatorID);

  try{
      var response = makeRequest(formData);
      response = JSON.parse(response);
      var  status = response.status;
      if(status == 200 ){
        alert('friend added');
      }else{
        alert('failed to confirm request');
      }
  }catch(e){
    console.log('friend request failed');
    console.log(e);
  }finally{
    var container = document.getElementById('request_view_container_body');
    container.removeChild(node);

  }

}

function loadRecievedFR(container){
  var requests = USER_INFO.pendingFriendRequests;
  var response = null;
  var users = null;
  requests = requests.split(',');
  for(var i=0; i < requests.length; i++){
    requests[i]=parseInt(requests[i]);
  }
  var formData = new FormData();
  formData.append('command',USERS_INFO_);
  try{
    var jsonObject = JSON.stringify({"ids":requests});
    formData.append('user_ids', jsonObject);
    var response = makeRequest(formData);
    response = JSON.parse(response);
    users = response.users;
    for(var i=0; i < users.length; i++){
      users[i]=JSON.parse(users[i]).info;
    }
  }catch(e){
    console.log('failed to parse friend requests');
    console.log(response);
    console.log(e);
  }
  console.log(users);
  loadUsers(users,container);

}

function confirmDeleteFriend(node){
    var yes;
    var name = node.innerHTML;
    if( confirm('unfriend ' +node.children[0].innerHTML+' ?') == true ){
        return true;
    }else{
        return false;
    }
}

function confirmAcceptFriend(node){
  var yes;
  var name = node.innerHTML;
  if( confirm('accept friend request from '+node.children[0].innerHTML+' ?') == true ){
      return true;
  }else{
      return false;
  }
}

function confirmAddFriend(node){
  var yes;
  var name = node.innerHTML;
  if( confirm('send friend request to '+node.children[0].innerHTML+' ?') == true ){
      return true;
  }else{
      return false;
  }
}
