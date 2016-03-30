function signIn() {
    var user_id = document.forms["login_form"]["user_id"].value;
    var pass = document.forms["login_form"]["pass"].value;
    var response;
    var params = "arg="+"login"+"&user_id="+user_id + "&pass="+pass;
    var response1, response2;


    var url = "php/controller.php";

    if ( (user_id.length > 0) &&  (pass.length > 0) ){
        resetFields();
        var XM = new XMLHttpRequest();
        XM.onreadystatechange=function(){
            if (XM.readyState==4){
                if (XM.status==200){
                    response = XM.responseText;
                    if(response == 1 ){
                        console.log("logged in..");
                    }
                }
                else{
                    alert("An error has occured making the request")
                }
            }
        }
        XM.open("POST",url,false);
        XM.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        XM.send(params);

    }
    else alert("please enter username & password!");
}

function resetFields(){
    document.forms["login_form"]["user_id"].value = "" ;
    document.forms["login_form"]["pass"].value = "" ;
}
function closeBox(){
    document.getElementById("info_box").style.visibility="hidden";
}
