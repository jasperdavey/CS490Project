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

}
