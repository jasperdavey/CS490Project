/*
** Totaram Ramrattan
** CS 490 Project - Front END
*/


/**************************SETTERS***************************/


function showEvents(events, container){
    var template = document.getElementById("event_0");
    // template = template.cloneNode(true);
    container.innerHTML="";
    // template.style.visibility='visible';
    var e = null;
    var name = null;
    var bio = null;
    var startDateTime = null;
    var endDateTime = null;
    var location = null;
    for (var i=0; i < events.length; i++ ){
        //create event view
        // var e = template.cloneNode(true);
        e = document.createElement('div');
        e.className = 'event_list_view';

        name = document.createElement('h1');
        name.innerHTML = events[i].name;

        e.appendChild(name);

        bio =  document.createElement('p');
        bio.innerHTML = events[0].bio;

        e.appendChild(bio);

        startDateTime = document.createElement('h1');
        startDateTime.innerHTML = events[i].startDateTime;

        e.appendChild(startDateTime);

        endDateTime = document.createElement('h1');
        endDateTime.innerHTML=events[i].endDateTime;

        e.appendChild(endDateTime);

        location = document.createElement('p');
        location.innerHTML = events[i].location;

        e.appendChild(location);


        // var childNodes = e.children;
        // childNodes[0].innerHTML=events[i].name;
        // childNodes[1].innerHTML=events[i].bio;
        // childNodes[2].children[0].innerHTML=events[i].startDateTime;
        // childNodes[3].children[0].innerHTML=events[i].endDateTime;
        e.id= events[i].id+'-'+container.id;

        e.onclick = function(){
            // checkGoogleCalAuth();
            handleReg(this);
            console.log(this.id);
        };

        container.appendChild(e);
    }
}


//load all users into view
function loadUsers(users, container){
    var containerID = container;
    var container = document.getElementById(container);
    var friends = USER_INFO.friends;
    console.log(friends.length);
    var fSet = new Set(friends);
    container.innerHTML="";

    if( users == null){
      users = getAllUsers();
    }

    var i = 0;
    var children = null;
    var tempNode = null;
    if( users.length > 0 ){
        for(i=0; i < users.length; i++){
          var node = document.createElement('div');
          node.className='other_user_view';
          // get children
          if( !users[i].username &&  !users[i].firstname){
            continue;
          }

          if( users[i].firstname && users[i].lastname){
            tempNode = document.createElement('h1');
            tempNode.innerHTML=users[i].firstname;
            node.appendChild(tempNode);
            tempNode = document.createElement('h2');
            tempNode.innerHTML=users[i].lastname;
            node.appendChild(tempNode);
          }else if( users[i].username){
            tempNode = document.createElement('h1');
            tempNode.innerHTML=users[i].username;
            node.appendChild(tempNode);
            tempNode = document.createElement('h2');
            tempNode.innerHTML='Organization';
            node.appendChild(tempNode);
          }

            tempNode = document.createElement('div');
            tempNode.id='other_user_img';
            node.appendChild(tempNode);
            node.id = 'user-'+users[i].id;

          if( containerID != 'request_view_container_body'){
              if( fSet.has( parseInt( users[i].id)) ){
                node.onclick = function(){
                  if(confirmDeleteFriend(this)){
                    console.log('deleting friend');
                  }
                }
            }else{
              node.onclick = function(){
                if(confirmAddFriend(this)){
                  makeFriendRequest(this.id.split('-')[1]);
                  console.log('sending friend request');
                }
              }
            }
          }else{ // this is  a friend request
            node.onclick = function(){
              if(confirmAcceptFriend(this)){
                acceptFriendRequest(this.id.split('-')[1],this);
                console.log('accepting friend request');
              }else{
                rejectFriendRequst(this.id.split('-')[1],this);
                console.log('rejecting friend request');
              }
            }

          }
            container.appendChild(node);

      }
    }
}


function populateWithMyEvents(container){
  var events = getMyEvents();
  container = document.getElementById(container);
  showEvents(events,container);
}

function populateWithGoingTo(container){
  var events = getAttendingEvents();
  container = document.getElementById(container);
  showEvents(events,container);
}
