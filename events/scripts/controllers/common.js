/*
** Totaram Ramrattan
** CS 490 Project - Front END
*/

//commands

var SIGNUP_ =1;
var LOGIN_ = 2;
var CREATE_EVENT_ = 3;
var SEND_FRIEND_REQUEST_ = 7;
var RECOMMENDED_EVENTS_ = 8;
var USER_INFO_ = 9;
var USERS_INFO_= 10;
var TAGS_ = 11;
var SEARCH_ = 12;
var FRIENDS_EVENTS_ = 13;
var ACCEPT_REQUEST_= 15;
var ALL_USERS_ = 16;
var ALL_EVENTS_ = 24;
var FUTURE_EVENTS_ = 31;
var EVENT_INFO_= 32;


//global variables
var USER_ID_ = null;
var USER_INFO = null;

var DEBUG_LOG = true;

/*************************************XMLHttpRequest****************************/

function makeRequest(params){
    var XM = new XMLHttpRequest();
    var url = "/~tr88/events/php/controller.php";
    var response;
    XM.onreadystatechange=function(){
        if (XM.readyState==4){
            if (XM.status==200){
                response = XM.responseText;
            }
            else{
                alert("An error has occured making the request")
            }
        }
    }
      XM.open("POST",url,false);
      XM.send(params);
    return response;
}

//debug log


/*********************************getters*************************************/
// get userinfo
function getUserInfo(){
    var command = USER_INFO_;
    var formData = new FormData();
    formData.append('command',command);
    try{
      var response = makeRequest( formData );
    }catch(e){
      console.log(e);
      console.log('response from getUserInfo: '+response);
      return null;
    }
    return response;
}

// get recommended events
function getRecommendedEvents(container){
    var container = document.getElementById(container);

    var command = RECOMMENDED_EVENTS_;
    var formData = new FormData();
    formData.append('command',command);
    var response = makeRequest(formData);
    var events = null;
    try{
        events = JSON.parse(response).events;
    }catch(e){
        console.log('failed to parse recommended events:response '+response);
        console.log(e);
    }
    if( events.length > 0){
        showEvents(events,container);
    }
}

// get future events
function getFutureEvents(container){
    var container = document.getElementById(container);

    var command = FUTURE_EVENTS_;
    var formData = new FormData();
    formData.append('command',command);
    var response = makeRequest(formData);
    console.log("future events: "+response);
    //display events
    var events = null;
    try{
        events = JSON.parse(response);
        events = events.events;
    }catch(e){
        console.log('failed to get future events');
    }
    console.log("returned future events: "+events);
    showEvents(events,container);
}


function getEvents( events ){
  var formData = new FormData();
  formData.append('command',EVENT_INFO_);
  var jsonObject = JSON.stringify({"ids": events});
  console.log("sending: "+jsonObject);
  formData.append('event_ids',jsonObject);
  var response = makeRequest(formData);
  console.log(response);
  var events = JSON.parse(response);
  events = events.events;
  var container = document.getElementById('events_list_container');
  showEvents(events,container);
}

// get friends events
function getFriendsEvents(container){

  var container = document.getElementById(container);
  var formData = new FormData();
  formData.append('command',FRIENDS_EVENTS_);
  formData.append('id',USER_INFO.id);
  var response = makeRequest(formData);
  //parse json {"status":200,"info":[["1","2"],[""],["1","7"]]}
  var response = JSON.parse(response);

  if(response.status != 200){
    alert('failed to get friends recommended events');
    return;
  }

  var set = new Set();
  //parse [["1","2"],[""],["1","7"]]
  var events = new Array();
  var arr = response.info;
  var count=0;
  var n = 0;
  for(var i=0; i < arr.length; i++){
    for(var j=0; j< arr[i].length; j++){
      n = parseInt(arr[i][j]);
      if( !isNaN(n) && !set.has(n) ){
        console.log(n);
        events.push(n);
        set.add(n);
        count+=1;
      }
    }
  }

  //get all events
  //temp static for testing -- till backend fix
  getEvents([6,13,14]);

}

//get friends
function getAllFriends(container){
  //check if info was saved
  var userInfo = USER_INFO;
  if (userInfo.friends == "") return;
  if( !userInfo.friends ){
    var response = getUserInfo();
    try {
      userInfo = JSON.parse(response).info;
      USER_INFO = userInfo;
    } catch (e) {
      console.log('failed to get user info');
      console.log('get userInfo response: '+response)
    }
  }

  //get friends
  var friends = userInfo;
  try{
    friends = userInfo.friends.split(',');
    for(var i=0; i < friends.length; i++){
      friends[i]=parseInt(friends[i]);
    }
    USER_INFO.friends = friends;
  }catch(e){
    console.log(e);
    friends = userInfo.friends;
  }

  var jsonObject = null;
  //break if no friends
  if ( friends != "" && friends.length < 1 ) return;

  var formData = new FormData();

  try{
    jsonObject = JSON.stringify({'ids':friends});
    console.log('friends ids json object: '+jsonObject);
  }catch(e){
    console.log('failed to create json of friend ids\n'+e);
  }

  formData.append('command',10);
  formData.append('user_ids',jsonObject);

  var response = makeRequest(formData);
  try{
    friends = JSON.parse(response).users;
  }catch(e){
    console.log(response);
    console.log(e);
  }
  for(var i=0; i < friends.length; i++){
    friends[i]=JSON.parse(friends[i]).info;
  }

  loadUsers(friends,'friends_view_container_body');
}

//load all users into view
function loadUsers(users, container){
    var containerID = container;
    var container = document.getElementById(container);
    var friends = USER_INFO.friends;
    console.log(friends.length);
    var fSet = new Set(friends);
    container.innerHTML="";

    if( users == null){
      users = getAllUsers();
    }

    var i = 0;
    var children = null;
    var tempNode = null;
    if( users.length > 0 ){
        for(i=0; i < users.length; i++){
          var node = document.createElement('div');
          node.className='other_user_view';
          // get children
          if( !users[i].firstname && !users[i].username ){
            continue;
          }

          if( users[i].firstname && users[i].lastname){
            tempNode = document.createElement('h1');
            tempNode.innerHTML=users[i].firstname;
            node.appendChild(tempNode);
            tempNode = document.createElement('h2');
            tempNode.innerHTML=users[i].lastname;
            node.appendChild(tempNode);
          }else if( users[i].username){
            tempNode = document.createElement('h1');
            tempNode.innerHTML=users[i].username;
            node.appendChild(tempNode);
            tempNode = document.createElement('h2');
            tempNode.innerHTML='Organization';
            node.appendChild(tempNode);
          }

            tempNode = document.createElement('div');
            tempNode.id='other_user_img';
            node.appendChild(tempNode);
            node.id = 'user-'+users[i].id;

          if( containerID != 'request_view_container_body'){
              if( fSet.has( parseInt( users[i].id)) ){
                node.onclick = function(){
                  if(confirmDeleteFriend(this)){
                    console.log('deleting friend');
                  }
                }
            }else{
              node.onclick = function(){
                if(confirmAddFriend(this)){
                  makeFriendRequest(this.id.split('-')[1]);
                  console.log('sending friend request');
                }
              }
            }
          }else{ // this is  a friend request
            node.onclick = function(){
              if(confirmAcceptFriend(this)){
                acceptFriendRequest(this.id.split('-')[1],this);
                console.log('accepting friend request');
              }else{

              }
            }

          }
            container.appendChild(node);

      }
    }
}


//get all users
function getAllUsers(){
  var formData = new FormData();
  formData.append('command',ALL_USERS_);
  var response = makeRequest(formData);

  var users = null;
  try{
    users = JSON.parse(response).info;
    for(var i=0; i < users.length;i++){
      users[i] = parseInt(users[i][0]);
    }

    var formData = new FormData();
    formData.append('command',10);
    $jsonObject = JSON.stringify({"ids":users});
    formData.append('user_ids',$jsonObject);
    response = makeRequest(formData);
    users = JSON.parse(response);
    console.log(users.users);
    users = users.users;
    for(var i=0; i < users.length; i++){
      users[i]=JSON.parse(users[i]).info;
    }
    return users;
  }catch(e){
    console.log(e);
    console.log('failed to get all users');
    users = [];
    return users;
  }

}

function HashTagHanlder(selectedContainer, nonSelectedContainer){
  var selectedTagsContainer = document.getElementById(selectedContainer);
  var nonSelectedTagsContainer = document.getElementById(nonSelectedContainer);
  var container = null;
  var selectCount=0;
  var userTags = new Set([]);
  var tags = [];

  this.getTags = function(){
    var command = TAGS_;
    var formData = new FormData();
    formData.append('command',command);
    var response = makeRequest(formData);
    try{
        tags = JSON.parse(response).tags;
    }catch(e){
        console.log('failed to get tags');
        console.log('response: '+response);
    }
    return tags;
    }

  this.loadUserTags = function(tags){
      try{
        for(var i=0; i < tags.length; i++){
            userTags.add(tags[i].tag);
        }
      }catch(e){
        console.log('failed to load user tags');
        console.log(e);
      }

  }

  this.displayHashTags = function(){
    selectCount = 0;
    if(nonSelectedContainer != null ){
    container = nonSelectedTagsContainer;
    var tags = this.getTags();
    var tag;

    for(var i=0; i < tags.length; i++){
        tag = document.createElement("button");
        tag.style.width="110px";
        tag.style.height="35px";
        tag.style.float="left"
        tag.style.fontSize="8pt";
        tag.innerHTML = tags[i];
        tag.onclick = function(){ addHashTag(container,this);};
        container.appendChild(tag);
    }
  }

    var container = selectedTagsContainer;
    var tags = this.getUserTags();

    tag = null;
    for(var i=0; i < tags.length; i++){
        tag = document.createElement("button");
        tag.style.width="110px";
        tag.style.height="35px";
        tag.style.float="left"
        tag.style.fontSize="8pt";
        tag.innerHTML = tags[i];
        tag.onclick = function(){
            removeThySelf(container,this);
        };
        container.appendChild(tag);
    }
  }

    function addHashTag(parent,tag){
    console.log('adding tag: '+tag.innerHTML);
    var container = null;
    if( parent != selectedTagsContainer){
        container = nonSelectedTagsContainer;
    }else{
        container = selectedTagsContainer;
    }
    var tagName = tag.innerHTML;
    var newTag = document.createElement("button");
    newTag.style.width="110px";
    newTag.style.height="35px";
    newTag.style.fontSize="8pt";
    newTag.style.float="left"
    newTag.innerHTML = tagName;
    newTag.onclick = function(){ removeThySelf(container,newTag);};
    container.appendChild(newTag);
    userTags.add(tagName);
    console.log('userTag Size: '+userTags.size);
    if( parent != selectedTagsContainer){
        selectedTagsContainer.removeChild(tag);
    }else{
        nonSelectedTagsContainer.removeChild(tag);
    }
  }


  function removeThySelf(parent,child){
      if(confirmDelete(child)){
          parent.removeChild(child);
          userTags.delete(child.innerHTML);
          console.log(userTags.size);
      }
  }

  function confirmDelete(node){
      var yes;
      var tag = node.innerHTML;
      if( confirm('remove ' +tag+' ?') == true ){
          return true;
      }else{
          return false;
      }
  }

  this.getUserTags = function(){
    var tagArray = [];
    userTags.forEach( function(value,set){ tagArray.push(value)})
    return tagArray;
  }

}
/******************************search functions ********************************/

function doSearch(container){
    var container = document.getElementById(container);
    var input_field = document.getElementById('search_value');
    var input = input_field.value;
    var formData = new FormData();
    formData.append('command',SEARCH_);
    formData.append('searchType','events');
    formData.append('searchText',input);
    var response = makeRequest(formData);
    var events = null;
    try{
      events = JSON.parse(response).results;
    }catch(e){
      console.log(e);
      console.log('failed to get search results, response: '+response);
      return false;
    }
    if(events.length > 0){
      showEvents(events,container);
      return true;
    }else{
      return false;
    }
}

function findPeople(container){
  var container = document.getElementById(container);
  var input_field = document.getElementById('people_search_input');
  var input = input_field.value;
  var formData = new FormData();
  formData.append('command',SEARCH_);
  formData.append('searchType','users');
  formData.append('searchText',input);
  var response = makeRequest(formData);
  var users = null;
  try{
    users = JSON.parse(response).results;
  }catch(e){
    console.log(e);
    console.log('failed to get search results, response: '+response);
    return false;
  }
  if(users.length > 0){
    loadUsers(users,'friends_view_container_body');
    return true;
  }else{
    return false;
  }
}

/****************************** end search functions ********************************/

function loadFutureEvents(){

}

function showEvents(events, container){
    var template = document.getElementById("event_0");
    template = template.cloneNode(true);
    container.innerHTML="";
    template.style.visibility='visible';

    for (var i=0; i < events.length; i++ ){
        //create event view
        var e = template.cloneNode(true);
        var childNodes = e.children;
        childNodes[0].innerHTML=events[i].name;
        childNodes[1].innerHTML=events[i].bio;
        childNodes[2].children[0].innerHTML=events[i].startDateTime;
        childNodes[3].children[0].innerHTML=events[i].endDateTime;
        e.id='event_'+i;
        e.onclick = function(){
            checkGoogleCalAuth();
        };
        container.appendChild(e);
    }
}
