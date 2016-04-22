/*********************************getters*************************************/
// get userinfo
function getUserInfo(){
    var command = USER_INFO_;
    var formData = new FormData();
    formData.append('command',command);
    try{
      var response = makeRequest( formData );
    }catch(e){
      console.log(e);
      console.log('response from getUserInfo: '+response);
      return null;
    }
    return response;
}

// get recommended events
function getRecommendedEvents(container){
    var container = document.getElementById(container);

    var command = RECOMMENDED_EVENTS_;
    var formData = new FormData();
    formData.append('command',command);
    var response = makeRequest(formData);
    var events = null;
    try{
        events = JSON.parse(response).events;
    }catch(e){
        console.log('failed to parse recommended events:response '+response);
        console.log(e);
    }
    if( events.length > 0){
        showEvents(events,container);
    }
}

// get future events
function getFutureEvents(container){
    var container = document.getElementById(container);

    var command = FUTURE_EVENTS_;
    var formData = new FormData();
    formData.append('command',command);
    var response = makeRequest(formData);
    console.log("future events: "+response);
    //display events
    var events = null;
    try{
        events = JSON.parse(response);
        events = events.events;
    }catch(e){
        console.log('failed to get future events');
    }
    console.log("returned future events: "+events);
    showEvents(events,container);
}

function getMyEvents(){
  //update user info function
  var events = USER_INFO.createdEvents;
  events = events.split(',');
  for(var i=0; i < events.length; i++){
    events[i]=parseInt(events[i]);
  }
  return getEvents(events);
}


function getEvents( events ){
  var formData = new FormData();
  formData.append('command',EVENT_INFO_);
  var jsonObject = JSON.stringify({"ids": events});
  console.log("sending: "+jsonObject);
  formData.append('event_ids',jsonObject);
  var response = makeRequest(formData);
  var events = JSON.parse(response);
  events = events.events;
  // var container = document.getElementById('events_list_container');
  // showEvents(events,container);
  return events;
}

// get friends events
function getFriendsEvents(container){

  var container = document.getElementById(container);
  var formData = new FormData();
  formData.append('command',FRIENDS_EVENTS_);
  formData.append('id',USER_INFO.id);
  var response = makeRequest(formData);
  //parse json {"status":200,"info":[["1","2"],[""],["1","7"]]}
  var response = JSON.parse(response);

  if(response.status != 200){
    alert('failed to get friends recommended events');
    return;
  }

  var set = new Set();
  //parse [["1","2"],[""],["1","7"]]
  var events = new Array();
  var arr = response.info;
  var count=0;
  var n = 0;
  for(var i=0; i < arr.length; i++){
    for(var j=0; j< arr[i].length; j++){
      n = parseInt(arr[i][j]);
      if( !isNaN(n) && !set.has(n) ){
        console.log(n);
        events.push(n);
        set.add(n);
        count+=1;
      }
    }
  }

  //get all events
  //temp static for testing -- till backend fix
  events = getEvents(events);
  showEvents(events,container);
}

//get friends
function getAllFriends(container){
  //check if info was saved
  var userInfo = USER_INFO;
  if (userInfo.friends == "") return;
  if( !userInfo.friends ){
    var response = getUserInfo();
    try {
      userInfo = JSON.parse(response).info;
      USER_INFO = userInfo;
    } catch (e) {
      console.log('failed to get user info');
      console.log('get userInfo response: '+response)
    }
  }

  //get friends
  var friends = userInfo;
  try{
    friends = userInfo.friends.split(',');
    for(var i=0; i < friends.length; i++){
      friends[i]=parseInt(friends[i]);
    }
    USER_INFO.friends = friends;
  }catch(e){
    console.log(e);
    friends = userInfo.friends;
  }

  var jsonObject = null;
  //break if no friends
  if ( friends != "" && friends.length < 1 ) return;

  var formData = new FormData();

  try{
    jsonObject = JSON.stringify({'ids':friends});
    console.log('friends ids json object: '+jsonObject);
  }catch(e){
    console.log('failed to create json of friend ids\n'+e);
  }

  formData.append('command',USERS_INFO_);
  formData.append('user_ids',jsonObject);

  var response = makeRequest(formData);
  try{
    friends = JSON.parse(response).users;
  }catch(e){
    console.log(response);
    console.log(e);
  }
  for(var i=0; i < friends.length; i++){
    friends[i]=JSON.parse(friends[i]).info;
  }

  loadUsers(friends,'friends_view_container_body');
}

//get all users
function getAllUsers(){
  var formData = new FormData();
  formData.append('command',ALL_USERS_);
  var response = makeRequest(formData);

  var users = null;
  try{
    users = JSON.parse(response).info;
    for(var i=0; i < users.length;i++){
      users[i] = parseInt(users[i][0]);
    }

    var formData = new FormData();
    formData.append('command',10);
    $jsonObject = JSON.stringify({"ids":users});
    formData.append('user_ids',$jsonObject);
    response = makeRequest(formData);
    users = JSON.parse(response);
    console.log(users.users);
    users = users.users;
    for(var i=0; i < users.length; i++){
      users[i]=JSON.parse(users[i]).info;
    }
    return users;
  }catch(e){
    console.log(e);
    console.log('failed to get all users');
    users = [];
    return users;
  }

}
