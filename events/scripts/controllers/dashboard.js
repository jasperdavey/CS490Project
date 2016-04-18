var hashTagHanlder = null;

function initDashBoard(){
  // get userInfo
  // var userInfo = null;
  // var events = null;
  // var firstname = null;
  // var lastname = null;
  // var username = null;
  // var bio = null;
  // var image = null;
  // var userEvents = null;
  // var friends = null;
  // var friendRequests = null;
  // var userTags = null;

  try {
    userInfo = JSON.parse(getUserInfo()).info[0];
  } catch (e) {
    console.log('failed to get user info');
  }
  finally{
      
  }

  try{
    events = JSON.parse(getRecommendedEvents()).events;
  }catch(e){
    console.log('failed to get events');
    events = [];
  }

  //parse userInfo into diffent fields
  if( userInfo != null ){
   // firstname = userInfo.firstname;
   // lastname = userInfo.lastname;
   // bio = userInfo.bio;
   // image = userInfo.image;
   // userEvents = userInfo.events;
   // friends = userInfo.friends;
   // userTags = userInfo.tags;
 }else{
     console.log("userInfo null");
 }

  // populate dom with fields
  document.getElementById("username").innerHTML = userInfo.firstname+" "+userInfo.lastname;
  document.getElementById("profile_name").innerHTML = userInfo.firstname+" "+userInfo.lastname;
  document.getElementById("profile_username").innerHTML = userInfo.username;
  document.getElementById("profile_email").innerHTML = userInfo.email;
  document.getElementById("profile_bio").innerHTML = userInfo.bio;
  document.getElementById("profile_tags").innerHTML = userInfo.tags;
  document.getElementById("events_list").innerHTML = events.length;

  document.getElementById("profile_header_image").style.backgroundImage='url(/~tr88/events/images/default_user.jpg)';

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
