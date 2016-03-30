//clear username and password fields
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
    var params = "arg="+"login"+"&user_id="+user_id + "&pass="+pass;

    var url = "php/controller.php";
    if ( (user_id.length > 0) &&  (pass.length > 0) ){
        resetFields();
        if(makeRequest(url,params) == 1){
            window.location.href=sign_up_page;
        }
    }
    else alert("please enter username & password!");
}


//sign up
function signUp(){
    var name = document.forms['sign_up_form']['name'].value;
    var username = document.forms['sign_up_form']['username'].value;
    var email = document.forms['sign_up_form']['email'].value;
    var password = document.forms['sign_up_form']['password'].value;
    console.log(username);
}

// HTTP request

function makeRequest(url,params){
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
