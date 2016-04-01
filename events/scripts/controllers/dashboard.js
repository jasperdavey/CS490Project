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
   closeDashMenu();
}

function cancelEventEntry(){
   var view = document.getElementById("createEventForm");
   view.style.visibility = "collapse";
}

function saveEvent(){
  var view = document.getElementById("createEventForm");
  view.style.visibility = "collapse";
  var response = makeEvent();
  if( response == 200 ){
      alert("event created!")
  }else{
    alert("failed to created event!")
  }
}


// create event
function makeEvent(){

    var name = document.forms['event_create_form']['name'].value;
    var image = document.forms['event_create_form']['image'].value;;
    var bio = document.forms['event_create_form']['bio'].value;
    var dateAndTime = document.forms['event_create_form']['dateAndTime'].value;;
    var location = document.forms['event_create_form']['location'].value;
    var command = 3;

    var params = "command="+command
      +"&"+"name="+name
      +"&"+"bio="+bio
      +"&"+"dateAndTime="+dateAndTime
      +"&"+"location="+location
      +"&"+"image="+image;
    var response = makeRequest(params);
     console.log("response: "+response);
     return response;
}
