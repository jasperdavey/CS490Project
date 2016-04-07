/*
  author: Totaram Ramrattan
  CS 490 Semseter Project EVENTS!
  3/30/16
*/

var sign_in_page = "/~tr88/events/index.html";
var sign_up_page = "/~tr88/events/views/signup.html";
var profile_creation = "/~tr88/events/views/profile_creation.html";
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
function indiSignUp(){
    console.log('signing up');
    var command = 0.1;
    var redirect_url = "/~tr88/events/views/tag_selection.html";
    var firstname = document.forms['sign_up_form_indi']['firstname'].value;
    var lastname = document.forms['sign_up_form_indi']['lastname'].value;
    var username = document.forms['sign_up_form_indi']['username'].value;
    var email = document.forms['sign_up_form_indi']['email'].value;
    var password = document.forms['sign_up_form_indi']['password'].value;

    //form verification
    if( !(firstname && lastname && username && email && password) ){
        alert('please fill in all fields');
        return;
    }

    document.forms['sign_up_form_indi'].reset();


    var params = "command="+command;
      +"&"+"firstname="+firstname
      +"&"+"lastname="+lastname
      +"&"+"username="+username
      +"&"+"email="+email
      +"&"+"password="+password;

      console.log(params);
      var response = makeRequest(params);
      console.log("response: "+response);

}

//sign up
function orgSignUp(){
    console.log('signing up');
    var command = 0.1;
    var redirect_url = "/~tr88/events/views/tag_selection.html";
    var organization = document.forms['sign_up_form_org']['organization_name'].value;
    var email = document.forms['sign_up_form_org']['email'].value;
    var password = document.forms['sign_up_form_org']['password'].value;

    //form verification
    if( !( organization && email && password) ){
        alert('please fill in all fields');
        return;
    }

    document.forms['sign_up_form_org'].reset();


    var params = "command="+command
      +"&"+"organization="+organization
      +"&"+"email="+email
      +"&"+"password="+password;

      console.log(params);
      window.location.href=profile_creation;
      // var response = makeRequest(params);
      // console.log("response: "+response);
      //
      // var data = JSON.parse(response);
      // if(data.status == 200 ){
      //   window.location.href=profile_creation;
      // }else{
      //   alert("failed to creater new user account");
      // }
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
  document.getElementById("events_list").innerHTML = events.length;
  document.getElementById("profile_header_image").style.backgroundImage='url(/~tr88/events/images/default_user.jpg)';

}

//load signup

function loadSignUp(){
  window.location.href=sign_up_page;
}

//group selection handler
function changeSingUpForm(button){
  var userType = button.innerHTML;
  var individualSignUpForm = document.getElementById("individual_sign_up_form");
  var organizationSignUpForm = document.getElementById("organization_sign_up_form");
  if( userType == 'Individual'){
      organizationSignUpForm.style.visibility = 'collapse';
      button.style.backgroundColor='red';
      individualSignUpForm.style.visibility = 'visible';
      document.getElementById("org_button").style='grey';
  }else{
    organizationSignUpForm.style.visibility = 'visible';
    button.style.backgroundColor='red';
    individualSignUpForm.style.visibility = 'collapse';
    document.getElementById("indi_button").style.backgroundColor='grey';
  }

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
