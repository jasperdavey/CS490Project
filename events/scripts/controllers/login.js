/*
  author: Totaram Ramrattan
  CS 490 Semseter Project EVENTS!
  3/30/16
*/

var sign_in_page = "events/index.html";
var sign_up_page = "/events/views/signup.html";
var tag_selection_page = "/events/views/tag_selection.html";
var dashboard_page = "/events/views/dashboard.html";


function resetFields(){
    document.forms["login_form"]["user_id"].value = "" ;
    document.forms["login_form"]["pass"].value = "" ;
}


// user login script
function signIn() {
    var sign_up_page ="views/signup.html";
    var user_id = document.forms["login_form"]["user_id"].value;
    var pass = document.forms["login_form"]["pass"].value;
    var response;
    var params = "arg="+"login"+ "&user_id="+user_id + "&pass="+pass;
    console.log("sending args: "+params);
    if ( (user_id.length > 0) &&  (pass.length > 0) ){
        resetFields();
        var response = makeRequest(params);
        if( response != 1){
            console.log("login fail: "+response);
            window.location.href=sign_up_page;
        }else{
          console.log("successfully logged in");
            window.location.href=dashboard_page;
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
    var arg = 'sign_up';
    var redirect_url = "../views/tag_selection.html";
    var f_name = document.forms['sign_up_form']['f_name'].value;
    var l_name = document.forms['sign_up_form']['l_name'].value;
    var username = document.forms['sign_up_form']['username'].value;
    var email = document.forms['sign_up_form']['email'].value;
    var password = document.forms['sign_up_form']['password'].value;

    document.forms['sign_up_form'].reset();

    var params = "arg="+arg
      +"&"+"f_name="+f_name
      +"&"+"l_name="+l_name
      +"&"+"username="+username
      +"&"+"email="+email
      +"&"+"password="+password;

      console.log(params);
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
