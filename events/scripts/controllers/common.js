// HTTP request
//commands

var SIGNUP_ =1;
var LOGIN_ = 2;
var CREATE_EVENT_ = 3;
var RECOMMENDED_EVENTS_ = 8;
var USER_INFO_ = 9;
var TAGS_ = 11;
var SEARCH_ = 12;
var ALL_EVENTS_ = 24;
var FUTURE_EVENTS_ = 25;

var USER_ID_ = null;

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

//get userinfo
function getUserInfo(){
  var command = USER_INFO_;
  var formData = new FormData();
  formData.append('command',command);
  var response = makeRequest( formData );
  console.log(response);
  return response;
}


function getRecommendedEvents(){
    var command = RECOMMENDED_EVENTS_;
    var formData = new FormData();
    formData.append('command',command);
    var response = makeRequest(formData);
    console.log("recommended events: "+response);
    //populate div with events
    return response;
}

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

    showEvents(events,container);
    return response;
}

function HashTagHanlder(){
  var selectCount=0;
  var bio= null;
  var userTags = new Set([]);
  var tags = [];

  this.getTags = function(){
    var command = TAGS_;
    var formData = new FormData();
    formData.append('command',command);
    var response = makeRequest(formData);
    try{
        console.log(response);
        tags = JSON.parse(response).tags;
    }catch(err){
        console.log('failed to get tags');
    }
    return tags;
  }

  this.displayHashTags = function(){
    selectCount = 0;
    var container = document.getElementById('tag_selection');
    var tags = this.getTags();
    if(!tags){
        tags = [];
    }
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

    function addHashTag(parent,tag){
    console.log('adding tag: '+tag.innerHTML);
    var container = document.getElementById('selected_tags');
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
    parent.removeChild(tag);
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

  this.resetVars = function(){

  }

}

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
    input_field.value = "";

    //test
    try{
      events = JSON.parse(response).results;
      if(events.length > 0){
        showEvents(events,container);
      }
    }catch(E){
      console.log('failed to get search results');
    }
    console.log('events length: '+events.length);
}

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
