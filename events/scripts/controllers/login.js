  function signIn() {

        var ucid = document.forms["login_form"]["ucid"].value;
        var pass = document.forms["login_form"]["pass"].value;
        var response;
        var params = "ucid="+ucid + "&pass="+pass;
        var response1, response2;
        var url = "https://web.njit.edu/~tr88/CS490Project/View/form_login2.php";

        if ( (ucid.length > 0) &&  (pass.length > 0) ){
            var XM = new XMLHttpRequest();
            XM.onreadystatechange=function(){
                if (XM.readyState==4){
                    if (XM.status==200){
                        document.getElementById("info_box").style.visibility="visible";
                        response = XM.responseText;
                        response = response.split(" ");

                        response1 = JSON.parse(response[0]);
                        response2 = JSON.parse(response[1]);

                        if(response1.status == 'failed'){
                            document.getElementById("status1").innerHTML = "Incorrect username or password!";
                        }else{
                            document.getElementById("status1").innerHTML = "Successfully logged in!";

                        }

                        document.getElementById("status2").innerHTML = response2.status;

                        switch (parseInt(response2.status)) {
                            case 200:
                                document.getElementById("status2").innerHTML = "Successfully logged in!";
                                break;
                            case 304:
                                document.getElementById("status2").innerHTML = "Incorrect password!";
                                break;
                            case 404:
                                document.getElementById("status2").innerHTML = "User not found!";
                                break;
                            default:
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

    function closeBox(){
        document.getElementById("info_box").style.visibility="hidden";
        document.forms["login_form"]["ucid"].value = "" ;
        document.forms["login_form"]["pass"].value = "" ;
    }
