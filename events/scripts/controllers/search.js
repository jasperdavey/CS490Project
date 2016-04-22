/******************************search functions ********************************/

function doSearch(container){
    var container = document.getElementById(container);
    var input_field = document.getElementById('search_value');
    var input = input_field.value;
    var formData = new FormData();
    formData.append('command',SEARCH_);
    formData.append('searchType','events');
    formData.append('searchText',input);
    var response = makeRequest(formData);
    var events = null;
    try{
      events = JSON.parse(response).results;
    }catch(e){
      console.log(e);
      console.log('failed to get search results, response: '+response);
      return false;
    }
    if(events.length > 0){
      showEvents(events,container);
      return true;
    }else{
      return false;
    }
}

function findPeople(container){
  var container = document.getElementById(container);
  var input_field = document.getElementById('people_search_input');
  var input = input_field.value;
  var formData = new FormData();
  formData.append('command',SEARCH_);
  formData.append('searchType','users');
  formData.append('searchText',input);
  var response = makeRequest(formData);
  var users = null;
  try{
    users = JSON.parse(response).results;
  }catch(e){
    console.log(e);
    console.log('failed to get search results, response: '+response);
    return false;
  }
  if(users.length > 0){
    loadUsers(users,'friends_view_container_body');
    return true;
  }else{
    return false;
  }
}

/****************************** end search functions ********************************/
