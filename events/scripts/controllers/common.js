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

/**
** GOOGLE CALENDAR API
**/
// Your Client ID can be retrieved from your project in the Google
// Developer Console, https://console.developers.google.com
var CLIENT_ID = '455038112884-5krp8paqma8knqlp7e7i4avdh7vf8qb9.apps.googleusercontent.com';

var SCOPES = ["https://www.googleapis.com/auth/calendar"];

/**
 * Check if current user has authorized this application.
 */
function checkGoogleCalAuth() {
  gapi.auth.authorize(
    {
      'client_id': CLIENT_ID,
      'scope': SCOPES.join(' '),
      'immediate': true
    }, handleAuthResult);
}

/**
 * Handle response from authorization server.
 *
 * @param {Object} authResult Authorization result.
 */
function handleAuthResult(authResult) {
  if (authResult && !authResult.error) {
    // Hide auth UI, then load client library.
    console.log('GOOGLE CALENDAR API: aurthorized');
    loadCalendarApi();
  } else {
    // Show auth UI, allowing the user to initiate authorization by
    // clicking authorize button.
    console.log('GOOGLE CALENDAR API: not aurthorized');
    handleAuth();
  }
}

/**
 * Initiate auth flow in response to user clicking authorize button.
 *
 * @param {Event} event Button click event.
 */
function handleAuth() {
  gapi.auth.authorize(
    {client_id: CLIENT_ID, scope: SCOPES, immediate: false},
    handleAuthResult);
  return false;
}

/**
 * Load Google Calendar client library. List upcoming events
 * once client library is loaded.
 */
function loadCalendarApi() {
  gapi.client.load('calendar', 'v3', listUpcomingEvents);
}

/**
 * Print the summary and start datetime/date of the next ten events in
 * the authorized user's calendar. If no events are found an
 * appropriate message is printed.
 */
function listUpcomingEvents() {
  var request = gapi.client.calendar.events.list({
    'calendarId': 'primary',
    'timeMin': (new Date()).toISOString(),
    'showDeleted': false,
    'singleEvents': true,
    'maxResults': 10,
    'orderBy': 'startTime'
  });

  request.execute(function(resp) {
    var events = resp.items;
    appendPre('Upcoming events:');

    if (events.length > 0) {
      for (i = 0; i < events.length; i++) {
        var event = events[i];
        var when = event.start.dateTime;
        if (!when) {
          when = event.start.date;
        }
        appendPre(event.summary + ' (' + when + ')')
      }
    } else {
      appendPre('No upcoming events found.');
    }

  });
}

/**
 * Append a pre element to the body containing the given message
 * as its text node.
 *
 * @param {string} message Text to be placed in pre element.
 */
function appendPre(message) {
  console.log(message);
  var pre = document.getElementById('my_upcoming_events');
  var textContent = document.createTextNode(message + '\n');
  pre.appendChild(textContent);
}

/*
*
* insert event into google calendar
*/

Uses the JavaScript client library.

// Refer to the JavaScript quickstart on how to setup the environment:
// https://developers.google.com/google-apps/calendar/quickstart/js
// Change the scope to 'https://www.googleapis.com/auth/calendar' and delete any
// stored credentials.

/*
var event = {
  'summary': 'Google I/O 2015',
  'location': '800 Howard St., San Francisco, CA 94103',
  'description': 'A chance to hear more about Google\'s developer products.',
  'start': {
    'dateTime': '2015-05-28T09:00:00-07:00',
    'timeZone': 'America/Los_Angeles'
  },
  'end': {
    'dateTime': '2015-05-28T17:00:00-07:00',
    'timeZone': 'America/Los_Angeles'
  },
  'recurrence': [
    'RRULE:FREQ=DAILY;COUNT=2'
  ],
  'attendees': [
    {'email': 'lpage@example.com'},
    {'email': 'sbrin@example.com'}
  ],
  'reminders': {
    'useDefault': false,
    'overrides': [
      {'method': 'email', 'minutes': 24 * 60},
      {'method': 'popup', 'minutes': 10}
    ]
  }
};
*/

function insertEventIntoCalendar( node ){
  // prompt for approval 
  var request = gapi.client.calendar.events.insert({
    'calendarId': 'primary',
    'resource': event
  });

  request.execute(function(event) {
    appendPre('Event created: ' + event.htmlLink);
  });
}
