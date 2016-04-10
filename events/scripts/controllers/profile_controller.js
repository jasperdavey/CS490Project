

// close profile view
function closeProfileView( node ){
  node.style.visibility="collapse";
}

function showProfileView(){
  document.getElementById('profile_container').style.visibility = 'visible';

  //hide dash menu if open close it'
  if(  document.getElementById('dashboard_menu').style.visibility == 'visible'){
    showDashMenu();
  }
}
