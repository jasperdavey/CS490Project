/*
** Totaram Ramrattan
** CS 490 Project - Front END
*/


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
    LINKED_TO_GOOGLE = true;
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
  var button = document.getElementById('link_google_calendar');
  button.style.visibility = 'collapse';
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

  console.log(date);
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

    if (events.length > 0) {
        var pre = document.getElementById('my_upcoming_events');
        pre.innerHTML="";
        var title= null;
        var location = null;
        var startTime = null;
        var endTime= null;
      for (i = 0; i < events.length; i++) {
        var event = events[i];
        var when = event.start.dateTime;
        if (!when) {
          when = event.start.date;
        }
        var end = event.end.dateTime;
        if( !end ){
          end = event.end.date;
        }
        var node = document.createElement('div');
        node.className = 'calendar_event';
        title = document.createElement('h1');
        title.innerHTML =event.summary;
        node.appendChild(title);
        location = document.createElement('h2');
        location.innerHTML = 'location: '+event.location;
        node.appendChild(location);
        startTime = document.createElement('h2');
        startTime.innerHTML = 'starts: '+when;
        node.appendChild(startTime);
        endTime = document.createElement('h2');
        endTime.innerHTML = 'ends: '+end;
        node.appendChild(endTime);

        appendPre(node);

      }

    } else {
    }

  });
}

/**
 * Append a pre element to the body containing the given message
 * as its text node.
 *
 * @param {string} message Text to be placed in pre element.
 */
function appendPre( node ) {
  var pre = document.getElementById('my_upcoming_events');
  pre.appendChild(node);
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



function insertEventIntoCalendar( event ){
  // prompt for approval
  var request = gapi.client.calendar.events.insert({
    'calendarId': 'primary',
    'resource': event
  });

  request.execute(function(event) {
     alert( 'insert event into google calendar!!');
  });
}
