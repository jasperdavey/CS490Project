/*
** Totaram Ramrattan
** CS 490 Project - Front END
*/


var sign_in_page = "/~tr88/events/index.html";
var sign_up_page = "/~tr88/events/views/signup.html";
var profile_creation = "/~tr88/events/views/profile_creation.html";
var dashboard_page = "/~tr88/events/views/dashboard.html";

var SIGN_OUT_ = -1;
var IS_LOGGED_IN_ = 0;
var SIGNUP_ = 1;
var LOGIN_ = 2;
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
    var command = LOGIN_;
    var params = "command="+command+ "&email="+email + "&password="+password;
    var formData = new FormData;
    formData.append('command',command);
    formData.append('email',email);
    formData.append('password',password);

    if ( (email.length > 0) &&  (password.length > 0) ){
        resetFields();
        var response = makeRequest(formData);
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
  var command = IS_LOGGED_IN_;
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



function signOut(){
  var command = SIGN_OUT_;
  var formData = new FormData();
  formData.append('command',SIGN_OUT_);
  var response = makeRequest(formData);
  console.log('signout response: '+response);
  if( response == 200){
    window.location.href=sign_in_page;
  }else{
    alert('failed to log out');
  }

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
