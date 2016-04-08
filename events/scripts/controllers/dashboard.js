var hashTagHanlder = null;

function initDashBoard(){
  // get userInfo
  var userInfo = JSON.parse(getUserInfo()).info;
  var events = JSON.parse(getRecommendedEvents()).events;

  //parse userInfo into diffent fields
  var firstname = userInfo.firstname;
  var lastname = userInfo.lastname;
  var bio = userInfo.bio;
  var image = userInfo.image;
  var userEvents = userInfo.events;
  var friends = userInfo.friends;
  var userTags = userInfo.tags;

  // populate dom with fields
  document.getElementById("username").innerHTML = userInfo.firstname+" "+lastname;
  document.getElementById("events_list").innerHTML = events.length;
  document.getElementById("profile_header_image").style.backgroundImage='url(/~tr88/events/images/default_user.jpg)';

}


function showDashMenu(){
    var x = document.getElementById('dashboard_menu');
    var y = document.getElementById('dashboard_menu_button');
    y.style.visibility="collapse";
    x.style.visibility="visible";
}

function closeDashMenu(){
    var x = document.getElementById('dashboard_menu');
    x.style.visibility="collapse";
    var y = document.getElementById('dashboard_menu_button');
    y.style.visibility="visible";
}

function initCreateEvent(){
   var view = document.getElementById("createEventForm");
   view.style.visibility = "visible";
   clearTags();
   closeDashMenu();
   hashTagHanlder = new HashTagHanlder();
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

    var name = document.forms['event_create_form']['name'].value;
    var image = document.forms['event_create_form']['image'].value;;
    var bio = document.forms['event_create_form']['bio'].value;
    var startDate = document.forms['event_create_form']['start_date'].value;
    var startTime = document.forms['event_create_form']['start_time'].value;
    var endDate = document.forms['event_create_form']['end_date'].value;
    var endTime = document.forms['event_create_form']['end_time'].value;
    var location = document.forms['event_create_form']['location'].value;
    var command = 3;

    var tags = hashTagHanlder.getUserTags();
    var jsonTags = JSON.stringify({'tags': tags});
    var params = "command="+command
      +"&"+"name="+name
      +"&"+"bio="+bio
      +"&"+'startDateTime='+startDate+' '+startTime+':00'
      +"&"+'endDateTime='+endDate+' '+endTime+':00'
      +"&"+"location="+location
      +"&"+"tags="+jsonTags
      +"&"+"image="+image;

    console.log(params);
    // var response = makeRequest(params);
    //  console.log("response: "+response);
    //  return response;
}
