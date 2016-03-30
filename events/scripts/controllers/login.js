//clear username and password fields
function resetFields(){
    document.forms["login_form"]["user_id"].value = "" ;
    document.forms["login_form"]["pass"].value = "" ;
}


// user login script
function signIn() {

    console.log('sign in');
    var sign_up_page ="views/signup.html";
    var user_id = document.forms["login_form"]["user_id"].value;
    var pass = document.forms["login_form"]["pass"].value;
    var response;
    var params = "arg="+"login"+ "&user_id="+user_id + "&pass="+pass;
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
    console.log('signing up');
    var arg = 'debug';
    var redirect_url = "../views/tag_selection.html";
    var f_name = document.forms['sign_up_form']['f_name'].value;
    var l_name = document.forms['sign_up_form']['l_name'].value;
    var username = document.forms['sign_up_form']['username'].value;
    var email = document.forms['sign_up_form']['email'].value;
    var password = document.forms['sign_up_form']['password'].value;

    var params = 'arg='+arg+'&'
        +'f_name='+f_name+'&'
        +'l_name='+l_name+'&'
        +'user_id='+username+'&'
        +'email='+email+'&'
        +'pass='+password;

    console.log(params);
    var url = "../php/controller.php";
    console.log(makeRequest(url,params));
    window.location.href=redirect_url;
}

// HTTP request

function makeRequest(url,params){
    var XM = new XMLHttpRequest();
    var response;
    console.log(params);
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
