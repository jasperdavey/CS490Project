// HTTP request
//commands

var SIGNUP_ =1;
var LOGIN_ = 2;
var CREATE_EVENT_ = 3;
var RECOMMENDED_EVENTS_ = 8;
var USER_INFO_ = 9;
var TAGS_ = 11;
var SEARCH_ = 12;
var ALL_USERS_ = 16;
var ALL_EVENTS_ = 24;
var FUTURE_EVENTS_ = 31;

//global variables
var USER_ID_ = null;
var USER_INFO = null;

var DEBUG_LOG = true;

//test data
var test_event_future = '{"events":[{"id":"5","name":"ACM","startDateTime":"2016-04-30 12:00:00","endDateTime":"2016-04-30 13:00:00","location":"GITC 2000","bio":"Event for CS students","owner":"1"},{"id":"5","name":"ACM","startDateTime":"2016-04-30 12:00:00","endDateTime":"2016-04-30 13:00:00","location":"GITC 2000","bio":"Event for CS students","owner":"1"},{"id":"5","name":"ACM","startDateTime":"2016-04-30 12:00:00","endDateTime":"2016-04-30 13:00:00","location":"GITC 2000","bio":"Event for CS students","owner":"1"},{"id":"5","name":"ACM","startDateTime":"2016-04-30 12:00:00","endDateTime":"2016-04-30 13:00:00","location":"GITC 2000","bio":"Event for CS students","owner":"1"},{"id":"5","name":"ACM","startDateTime":"2016-04-30 12:00:00","endDateTime":"2016-04-30 13:00:00","location":"GITC 2000","bio":"Event for CS students","owner":"1"},{"id":"5","name":"ACM","startDateTime":"2016-04-30 12:00:00","endDateTime":"2016-04-30 13:00:00","location":"GITC 2000","bio":"Event for CS students","owner":"1"}]}';

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

function loadAllUsers(container){
    var container = document.getElementById(container);
    var template = container.children[0].cloneNode(true);
    container.innerHTML="";
    var users = getAllUsers();
    console.log(users);
    var i = 0;
    var children = null;
    if( users.length > 0 ){
        for(i=0; i < users.length; i++){
          var node = template.cloneNode(true);
          // get children
          children = node.children;
          if( users[i].firstname && users[i].lastname){
            children[0].innerHTML= users[i].firstname;
            children[1].innerHTML= users[i].lastname;
          }
          node.id = 'user-'+users[i].id;
          node.onclick = function(node){
            console.log('clicked: '+node.target.id);
          }
          node.style.visibility='visible';
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
    users = JSON.parse(response).Users;
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
        tag.onclick = function(){ addHashTag(container,this);};
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
      var selection_tags = document.getElementById("tag_selection");

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
    console.log('container: '+container);
    var container = document.getElementById(container);
    var input_field = document.getElementById('search_value');
    var input = input_field.value;
    console.log(input);
    var formData = new FormData();
    formData.append('command',SEARCH_);
    formData.append('searchType','events');
    formData.append('searchText',input);
    var response = makeRequest(formData);
    console.log(response);
    //test

    try{
      events = JSON.parse(response).results;
    }catch(e){
      console.log(e);
      console.log('failed to get search results');
      return false;
    }
    console.log('events length: '+events.length);
    if(events.length > 0){
      showEvents(events,container);
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
    // var childNodes = template.children;
    // childNodes[0].innerHTML=events[0].name;
    // childNodes[1].innerHTML=events[0].bio;
    // childNodes[2].children[0].innerHTML=events[0].startDateTime;
    // childNodes[3].children[0].innerHTML=events[0].endDateTime;
    //
    // for( var i =0; i < childNodes.length; i++){
    //     console.log(childNodes[i].id);
    // }
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
