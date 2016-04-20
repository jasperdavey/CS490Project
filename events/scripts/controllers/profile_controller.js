

// close profile view
function closeProfileView( node ){
  node.style.visibility="collapse";
}

function showProfileView(){
  document.getElementById('profile_container').style.visibility = 'visible';
  var tagHandler = new HashTagHanlder('profile_selected_tags','profile_tags_selection');
  tagHandler.displayHashTags();

  //hide dash menu if open close it'
  if(  document.getElementById('dashboard_menu').style.visibility == 'visible'){
    showDashMenu();
  }
}
