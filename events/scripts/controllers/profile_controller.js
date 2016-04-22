

// close profile view
function closeProfileView( node ){
  node.style.visibility="collapse";
  document.getElementById('friends_view_container_body').innerHTML="";
}

function showProfileView(){
  document.getElementById('profile_container').style.visibility = 'visible';

  //init HashTagHanlder
  var tagHandler = new HashTagHanlder('profile_selected_tags',null);
  if(USER_INFO != null){
      var tags = USER_INFO.tags;
      document.getElementById('profile_selected_tags').innerHTML="";

      //load user tags into HashTagHanlder
      tagHandler.loadUserTags(tags);
      tagHandler.displayHashTags();
  }else{
    console.log('failed to get user tags:response-'+response);
  }
  //load friends
  getAllFriends('friends_view_container_body');
  //hide dash menu if open close it'
  if(  document.getElementById('dashboard_menu').style.visibility == 'visible'){
    showDashMenu();
  }
}
