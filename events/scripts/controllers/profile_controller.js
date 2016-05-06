/*
** Totaram Ramrattan
** CS 490 Project - Front END
*/


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

  if(  document.getElementById('dashboard_menu').style.visibility == 'visible'){
    initDashBoard();
    showDashMenu();
  }

  //load friends
  getAllFriends('friends_view_container_body');
  loadRecievedFR('request_view_container_body');
  initDashBoard();
  //hide dash menu if open close it'

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
    initDashBoard();
    container.removeChild(node);
    getAllFriends('friends_view_container_body');
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

  loadUsers(users,container);


}

/******************** events ***********************************************/

function handleReg(node){
  var id = parseInt(node.id.split('-')[0]);
  var createdEvents = USER_INFO.createdEvents;
  var attendingEvents = USER_INFO.events;

  createdEvents = parseEventsString(createdEvents);
  attendingEvents = parseEventsString(attendingEvents);

  var createdSet = new Set(createdEvents);
  var attendingSet = new Set(attendingEvents);

  if( attendingSet.has(id)){
      confirmEeventUnReg(node,id);
    return;
  }else if( createdSet.has(id)){
    console.log('you created this');
  }else{
      console.log('need to sign up');
      confirmEventReg(node,id);
  }


}


function confirmDeleteFriend(node){
    var yes;
    var name = node.innerHTML;
    var id = parseInt(node.id.split('-')[1]);
    console.log(id);
    if( confirm('unfriend ' +node.children[0].innerHTML+' ?') == true ){
        if(unFriend(id)){
          var container = document.getElementById('friends_view_container_body');
          container.removeChild(node);
        }
        return true;
    }else{
        return false;
    }
}

function unFriend(id){
  var formData = new FormData();
  formData.append('command',REMOVE_FRIEND_);
  formData.append('initiatorID',USER_INFO.id);
  formData.append('targetID',id);
  var response = makeRequest(formData);
  response = JSON.parse(response);
  if( response.status == 200 ){
    alert('removed friend');
    return true;
  } else{
    alert('failed to remove friend');
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

function rejectFriendRequst(id,node){
  var formData = new FormData();
  formData.append('command',REJECT_FRIEND_);
  formData.append('initiatorID',USER_INFO.id);
  formData.append('targetID',id);
  var response = makeRequest(formData);
  response = JSON.parse(response);
  if( response.status == 200 ){
    alert('rejected friend request');
    var container = document.getElementById('request_view_container_body');
    container.removeChild(node);
    return true;
  } else{
    alert('failed to reject friend request');
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

function confirmEventReg(node,event_id){
  var yes;
  var name = node.children[0].innerHTML;
  if( confirm('register for '+node.children[0].innerHTML+' ?') == true ){
      registerForEvent(event_id,node);
      initDashBoard();
      return true;
  }else{
      return false;
  }
}

function confirmEeventUnReg(node,event_id){
  var yes;
  var name = node.children[0].innerHTML;
  if( confirm('unregister for '+node.children[0].innerHTML+' ?') == true ){
      if(unRegisterForEvent(event_id)){
        var parent = document.getElementById('my_events_container');
        parent.removeChild(node);
      }
      initDashBoard();
      return true;
  }else{
      return false;
  }
}


function makeGoogleEvent(summary,location, description,start, end){

  var event = {
    'summary': summary,
    'location': location,
    'description': description,
    'start': {
      'dateTime': start,
      'timeZone': 'America/New_York'
    },
    'end': {
      'dateTime': end,
      'timeZone': 'America/New_York'
    }
  };

  return event;

}

function registerForEvent(event_id,node){
  var formData = new FormData();
  formData.append('command',EVENT_REG_ADD_);
  formData.append('event',event_id);
  formData.append('id',USER_INFO.id);
  node = node.children;
  summary = node[0].innerHTML;
  description = node[1].innerHTML;
  start = (node[2].innerHTML).split(' ').join('T');
  end = (node[3].innerHTML).split(' ').join('T');
  event_location = node[4].innerHTML;
  var event = makeGoogleEvent(summary,event_location,description,start,end);
  var response = makeRequest(formData);
  try{
    response = JSON.parse(response);
    if( response.status == 200 ){
      alert('registed for event!!');
      if(LINKED_TO_GOOGLE){
        insertEventIntoCalendar(event);
      }
    }else{
      alert('failed to registed for event!!');
    }
  }catch(e){
    console.log('failed to parse json, register for event');
    console.log(e);
  }
}

function unRegisterForEvent(event_id){
  var formData = new FormData();
  formData.append('command',EVENT_REG_REMOVE_);
  formData.append('event',event_id);
  formData.append('id',USER_INFO.id);

  var response = makeRequest(formData);
  try{
    response = JSON.parse(response);
    if( response.status == 200 ){
      return true;
    }else{
      alert('failed to unregisted for event!!');
    }
  }catch(e){
    console.log('failed to parse json, unregister for event');
    console.log(e);
  }

  return false;
}
