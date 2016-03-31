/*
  author: Totaram Ramrattan
  CS 490 Semseter Project EVENTS!
  3/30/16
*/

var sign_in_page = "events/index.html";
var sign_up_page = "/events/views/signup.html";
var tag_selection_page = "/events/views/tag_selection.html";
var dashboard_page = "/events/views/dashboard.html";

//codes

var loggedIn = 200;
var loginFail = 404;

function resetFields(){
    document.forms["login_form"]["email"].value = "" ;
    document.forms["login_form"]["password"].value = "" ;
}


// user login script
function signIn() {
    var sign_up_page ="views/signup.html";
    var email = document.forms["login_form"]["email"].value;
    var password = document.forms["login_form"]["password"].value;
    var response;
    var command = 2;
    var params = "command="+command+ "&email="+email + "&password="+password;
    console.log("sending args: "+params);
    if ( (email.length > 0) &&  (password.length > 0) ){
        resetFields();
        var response = makeRequest(params);
        if( response != 200){
            console.log("login fail: "+response);
            window.location.href=sign_up_page;
        }else{
        //   console.log("successfully logged in");
            // window.location.href=dashboard_page;
        }
    }
    else alert("please enter username & password!");
}

//login check
function isLoggedIn(){
  var arg = 'login_check';
  var params = 'arg='+arg;
  var response = makeRequest(params);
  if(response == 1){
    window.location.href=sign_up_page;
  }else{
    console.log("need to log in");
  }
}

//sign up
function signUp(){
    console.log('signing up');
    var command = 1;
    var redirect_url = "../views/tag_selection.html";
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

}

// create event
function makeEvent(){

    var name = document.forms['event_create_form']['name'].value;
    var image = document.forms['event_create_form']['image'].value;;
    var bio = document.forms['event_create_form']['bio'].value;
    var dateAndTime = document.forms['event_create_form']['dateAndTime'].value;;
    var location = document.forms['event_create_form']['location'].value;
    var command = 3;

    var params = "command="+command
      +"&"+"name="+name
      +"&"+"bio="+bio
      +"&"+"dateAndTime="+dateAndTime
      +"&"+"location="+location
      +"&"+"image="+image;
    //  console.log(params)
    var response = makeRequest(params);
     console.log("response: "+response);
}


function getRecommendedEvents(){
    var command = 8;
    var name = "testUser";
    var params = "command="+command+"&"+"username="+name;
    var response = makeRequest(params);
    console.log("response: "+response);
}

// HTTP request
function makeRequest(params){
    var url = "/events/php/controller.php";
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

//load sing up page

function loadSignUp(){
  window.location.href=sign_up_page;
}
