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
var EVENT_REG_ADD_ =10
var TAGS_ = 11;
var SEARCH_ = 12;
var FRIENDS_EVENTS_ = 13;
var ACCEPT_REQUEST_= 15;
var ALL_USERS_ = 16;
var EVENT_REG_REMOVE_ = 20;
var ALL_EVENTS_ = 24;
var FUTURE_EVENTS_ = 31;
var EVENT_INFO_= 32;
var REJECT_FRIEND_ = 35;
var REMOVE_FRIEND_ = 36;
var USERS_INFO_= 40;
var LINKED_TO_GOOGLE = false;



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


function parseEventsString(events){
  events = events.split(',');
  for(var i=0; i < events.length; i++){
    events[i]=parseInt(events[i]);
  }

  return events;
}

function loadSpinner(){
    spinner = document.getElementById('spinner');
    spinner.style.visibility = 'visible';
    console.log(spinner.style.visibility);

}

function hideSpinner(){
    spinner = document.getElementById('spinner');
    spinner.style.visibility = 'collapse';
    console.log(spinner.style.visibility);

}
