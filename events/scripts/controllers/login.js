/*
  author: Totaram Ramrattan
  CS 490 Semseter Project EVENTS!
  3/30/16
*/

var sign_in_page = "/~tr88/events/index.html";
var sign_up_page = "/~tr88/events/views/signup.html";
var tag_selection_page = "/~tr88/events/views/tag_selection.html";
var dashboard_page = "/~tr88/events/views/dashboard.html";

//codes

var success = 200;
var fail = 404;

function resetFields(){
    document.forms["login_form"]["email"].value = "" ;
    document.forms["login_form"]["password"].value = "" ;
}


// user login script
function signIn() {
    var sign_up_page ="/~tr88/events/views/signup.html";
    var email = document.forms["login_form"]["email"].value;
    var password = document.forms["login_form"]["password"].value;
    var response;
    var command = 2;
    var params = "command="+command+ "&email="+email + "&password="+password;
    console.log("sending args: "+params);
    if ( (email.length > 0) &&  (password.length > 0) ){
        resetFields();
        var response = makeRequest(params);
            console.log("mid-response: "+response);
        if( response == 200){
            console.log("successfullly logged in!");
            window.location.href=dashboard_page;
        }else{
            console.log("login fail: "+response);
            if(window.location.href != sign_up_page){
                window.location.href=sign_up_page;
            }
        }
    }
    else alert("please enter username & password!");
}

//login check
function isLoggedIn(){
  var command = 0;
  var params = 'command=' + command;
  var response = makeRequest(params);
  if(response == 200 ){
    console.log("your alreaday logged in..");
    if(window.location.pathname == dashboard_page){
      console.log("init dashboard");
      initDashBoard();
    }
  }else{
    console.log("need to log in");
    pathname = window.location.pathname;
    if( pathname != sign_in_page){
        window.location.href=sign_in_page;
    }
  }
}

//sign up
function signUp(){
    console.log('signing up');
    var command = 1;
    var redirect_url = "/~tr88/events/views/tag_selection.html";
    var firstname = document.forms['sign_up_form']['firstname'].value;
    var lastname = document.forms['sign_up_form']['lastname'].value;
    var username = document.forms['sign_up_form']['username'].value;
    var email = document.forms['sign_up_form']['email'].value;
    var password = document.forms['sign_up_form']['password'].value;

    document.forms['sign_up_form'].reset();

    var params = "command="+command
      +"&"+"firstname="+firstname
      +"&"+"lastname="+lastname
      +"&"+"username="+username
      +"&"+"email="+email
      +"&"+"password="+password;

      console.log(params);
      var response = makeRequest(params);
      console.log("response: "+response);

      var data = JSON.parse(response);
      if(data.status == 200 ){
        window.location.href=dashboard_page;
      }else{
        alert("failed to creater new user account");
      }
}



function getRecommendedEvents(){
    var command = 8;
    var params = "command="+command;
    var response = makeRequest(params);
    console.log("recommended events: "+response);
    return response;
}


function signOut(){
  var command = -1;
  var params = "command="+command;
  var response = makeRequest(params);
  if( response == 200){
    window.location.href=sign_in_page;
  }else{
    alert('failed to log out');
  }

}


//get userinfo
function getUserInfo(){
  var command = 9;
  var params = "command="+command;
  var response = makeRequest(params);
  console.log("getting user info");
  console.log(response);
  return response;
}


function initDashBoard(){
  // get userInfo
  var userInfo = JSON.parse(getUserInfo()).info;
  var events = JSON.parse(getRecommendedEvents()).events;

  //parse userInfo into diffent fields
  var firstname = userInfo.firstname;
  var lastname = userInfo.lastname;
  var bio = userInfo.bio;
  var image = userInfo.image;
  var userEvents = userInfo.events;
  var friends = userInfo.friends;
  var userTags = userInfo.tags;

  // populate dom with fields
  document.getElementById("username").innerHTML = userInfo.firstname+" "+lastname;
  document.getElementById("recommendEvents").innerHTML = events.length;

}

//load signup

function loadSignUp(){
  window.location.href=sign_up_page;
}

// HTTP request
function makeRequest(params){
    var url = "/~tr88/events/php/controller.php";
    var XM = new XMLHttpRequest();
    var response;
    XM.onreadystatechange=function(){
        if (XM.readyState==4){
            if (XM.status==200){
                response = XM.responseText;
            }
            else{
                alert("An error has occured making the request")
            }
        }
    }
    XM.open("POST",url,false);
    XM.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    XM.send(params);
    return response;
}
