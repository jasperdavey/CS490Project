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


var dashSearch = document.getElementById('search_bar').oninput = function(e){
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
  if(e.target.value.length > 1){
    eventViewChanged=findPeople('friends_view_container_body');
  }else{
    if(eventViewChanged){
      loadUsers(null,'friends_view_container_body');
      eventViewChanged = false;
    }
  }
}

function showDateValue(date){
    console.log('date value: '+date.value);
    listUpcomingEvents(date.value);
}

/************************initDashBoard********************************/
function initDashBoard(){
  // get userInfo
  var userInfo = null;
  document.getElementById('mycal_date_selector').value = new Date().toDateInputValue();
  var response = getUserInfo();
  try {
    userInfo = JSON.parse(response).info;
    USER_INFO = userInfo;
    USER_ID = userInfo.id;
  } catch (e) {
    console.log('failed to get user info');
    console.log('get userInfo response: '+response)
  }

  try{
      getRecommendedEvents('events_list_container');
      populateWithMyEvents('my_events_container');
  }catch(e){
    console.log('failed to get recommended events');
    events = [];
  }

  // populate dom with fields
  if(userInfo != null){
    if( userInfo.firstname && userInfo.lastname){
      document.getElementById("username").innerHTML = userInfo.firstname+" "+userInfo.lastname;
      document.getElementById("profile_name").innerHTML = userInfo.firstname+" "+userInfo.lastname;
      document.getElementById("profile_username").innerHTML = userInfo.username;
    }else{
      document.getElementById("username").innerHTML = userInfo.username;
      document.getElementById("profile_name").innerHTML = userInfo.username;
      document.getElementById("profile_username").innerHTML = userInfo.username;

    }

    document.getElementById("profile_email").innerHTML = userInfo.email;
    document.getElementById("profile_bio").innerHTML = userInfo.bio;
  }else{
    console.log('unable to get user info');
  }

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

    console.log('saving event    ...');
    var formData = new FormData();

    var name = document.forms['event_create_form']['name'].value;
    var imageUrl = document.forms['event_create_form']['upload_image'].value;;
    var bio = document.forms['event_create_form']['bio'].value;
    var startDate = document.forms['event_create_form']['start_date'].value;
    var startTime = document.forms['event_create_form']['start_time'].value;
    var endDate = document.forms['event_create_form']['end_date'].value;
    var endTime = document.forms['event_create_form']['end_time'].value;
    var location = document.forms['event_create_form']['location'].value;

    var upload = document.getElementById("upload_image");
    var file = null;

    if( 'files' in upload ){
          file = upload.files[0];
          if(file != null){
          console.log('what');
          // Create a new FormData object.
          if(!file.type.match('image.*')){
            return;
          }
         formData.append('image',file,file.name)
          console.log('file name:'+file.name);
          console.log('file type:'+file.type);
        }
    }else{
      console.log('file not detected');
    }


    var tags = hashTagHanlder.getUserTags();
    var jsonTags = JSON.stringify({'tags': tags});

    formData.append('command',3);
    formData.append('name',name);
    formData.append('bio',bio);
    formData.append('startDateTime',startDate+' '+startTime+':00');
    formData.append('endDateTime',endDate+'endTime'+':00');
    formData.append('location',location);
    formData.append('tags',jsonTags);
    formData.append('owner',USER_ID);

    cancelEventEntry();
    var response = makeRequest(formData);
    console.log("response: "+response);
}
