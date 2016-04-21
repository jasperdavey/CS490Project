var hashTagHanlder = null;
var eventViewChanged = false;

function hello(x){
    console.log('hello'+x);
}
Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});


var dashSearch = document.getElementById('search_bar');
dashSearch.oninput= function(e){
  if(e.target.value.length > 1){
    eventViewChanged=doSearch('events_list_container');
  }else{
    if(eventViewChanged){
      getFutureEvents('events_list_container');
      eventViewChanged = false;
    }
  }
}

var peopleSearch = document.getElementById('people_search_input').oninput = function(e){
  console.log(e.target.value);
}

function showDateValue(date){
    console.log('date value: '+date.value);
    listUpcomingEvents(date.value);
}

function initDashBoard(){
  // get userInfo
  var userInfo = null;
  document.getElementById('mycal_date_selector').value = new Date().toDateInputValue();
  var response = getUserInfo();
  try {
    userInfo = JSON.parse(response).info;
    USER_INFO = userInfo;
  } catch (e) {
    console.log('failed to get user info');
    console.log('get userInfo response: '+response)
  }

  try{
      getRecommendedEvents('events_list_container');
  }catch(e){
    console.log('failed to get recommended events');
    events = [];
  }

  // populate dom with fields
  if(userInfo != null){
    document.getElementById("username").innerHTML = userInfo.firstname+" "+userInfo.lastname;
    document.getElementById("profile_name").innerHTML = userInfo.firstname+" "+userInfo.lastname;
    document.getElementById("profile_username").innerHTML = userInfo.username;
    document.getElementById("profile_email").innerHTML = userInfo.email;
    document.getElementById("profile_bio").innerHTML = userInfo.bio;
  }else{
    console.log('unable to get user info');
  }

  //check if google api is linked
  checkGoogleCalAuth();
}


function showDashMenu(){

    var x = document.getElementById('dashboard_menu');
    var y = document.getElementById('dashboard_menu_button');

    if(x.style.visibility == 'visible'){
      y.style.backgroundImage='url(/~tr88/events/images/menu_icon.png)';
      x.style.visibility="collapse";
    }else{
      y.style.backgroundImage='url(/~tr88/events/images/x_icon.png)'
      x.style.visibility="visible";
    }
}

function closeDashMenu(){
    showDashMenu();
}

function initCreateEvent(){
   var view = document.getElementById("createEventForm");
   view.style.visibility = "visible";
   clearTags();
   closeDashMenu();
   // selectedContainer, nonSelectedContainer
   hashTagHanlder = new HashTagHanlder('selected_tags','tag_selection');
   hashTagHanlder.displayHashTags();
}

function cancelEventEntry(){
   var view = document.getElementById("createEventForm");
   view.style.visibility = "collapse";
}

function saveEvent(){
  var view = document.getElementById("createEventForm");
  view.style.visibility = "collapse";
  // var response = makeEvent();
  if( response == 200 ){
      alert("event created!")
      cancelEventEntry();
  }else{
    alert("failed to created event!")
  }
}

// clear all tags from previous instance of create event
function clearTags(){
  var selectedContainer = document.getElementById("selected_tags");
  var selectionContainer = document.getElementById("tag_selection");
  while (selectionContainer.hasChildNodes()) {
    selectionContainer.removeChild(selectionContainer.lastChild);
  }
  while (selectedContainer.hasChildNodes()) {
    selectedContainer.removeChild(selectedContainer.lastChild);
  }
}


// create event
function makeEvent(){

    console.log('saving event...');
    var formData = new FormData();

    var name = document.forms['event_create_form']['name'].value;
    var imageUrl = document.forms['event_create_form']['upload_image'].value;;
    var bio = document.forms['event_create_form']['bio'].value;
    var startDate = document.forms['event_create_form']['start_date'].value;
    var startTime = document.forms['event_create_form']['start_time'].value;
    var endDate = document.forms['event_create_form']['end_date'].value;
    var endTime = document.forms['event_create_form']['end_time'].value;
    var location = document.forms['event_create_form']['location'].value;
    var command = 3;

    var upload = document.getElementById("upload_image");
    var file = null;
    if( 'files' in upload ){
        file = upload.files[0];

        // Create a new FormData object.
        if( !file.type.match('image.*')){
           return;
         }

        formData.append('image',file,file.name)
        console.log('file name:'+file.name);
        console.log('file type:'+file.type);
    }else{
      console.log('file not detected');
    }


    var tags = hashTagHanlder.getUserTags();
    var jsonTags = JSON.stringify({'tags': tags});

    formData.append('command',command);
    formData.append('name',name);
    formData.append('bio',bio);
    formData.append('startDateTime',startDate+' '+startTime+':00');
    formData.append('endDateTime',endDate+'endTime'+':00');
    formData.append('location',location);
    formData.append('tags',jsonTags);

    // var params = "command="+command
    //   +"&"+"name="+name
    //   +"&"+"bio="+bio
    //   +"&"+'startDateTime='+startDate+' '+startTime+':00'
    //   +"&"+'endDateTime='+endDate+' '+endTime+':00'
    //   +"&"+"location="+location
    //   +"&"+"tags="+jsonTags

    console.log(formData);
    cancelEventEntry();
    var response = makeRequest(formData);
    console.log("response: "+response);
    //  return response;
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
function listUpcomingEvents(date) {
  if(date == null){
      date = (new Date().toISOString());
  }else{
      date = (new Date(date.split('-').join(',')).toISOString());
  }
  var request = gapi.client.calendar.events.list({
    'calendarId': 'primary',
    'timeMin': date,
    'showDeleted': false,
    'singleEvents': true,
    'maxResults': 10,
    'orderBy': 'startTime'
  });

  request.execute(function(resp) {
    var events = resp.items;
    appendPre('Upcoming events:');

    if (events.length > 0) {
        var pre = document.getElementById('my_upcoming_events');
        pre.innerHTML="";
      for (i = 0; i < events.length; i++) {
        var event = events[i];
        // console.log(event);
        var when = event.start.dateTime;
        if (!when) {
          when = event.start.date;
        }
        appendPre(event.summary + ' (' + event.location + ')')
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
  // console.log(message);
  var pre = document.getElementById('my_upcoming_events');
  var textContent = document.createTextNode(message + '\n');
  pre.appendChild(textContent);
}

/*
*
* insert event into google calendar
*/

// Uses the JavaScript client library.

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
