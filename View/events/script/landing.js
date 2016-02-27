
function login(){
    var user = document.forms["login_form"]["user"].value;
    var pass = document.forms["login_form"]["pass"].value;
    document.forms["login_form"]["user"].value = "";
    document.forms["login_form"]["pass"].value = "";
}

function clearText(input){
    if(input.name == "user" && input.value == "username"){
        input.value = "";
        input.style.color = "black";
    }
    else if (input.name == "pass" && input.value == "password"){
        input.value = "";
        input.style.color = "black";
        input.type = "password";
    }
}

function resetText(input){
    if(input.name == "user" && input.value == ""){
        input.style.color = "grey";
        input.value  = "username";
    }
    else if ( input.name == "pass" && input.value == ""){
        input.style.color = "grey";
        input.type="text";
        input.value = "password";

    }
}

function highlight(x){
    x.style.color = "yellow";
}

function unHighlight(x){
    x.style.color = "white";
}
