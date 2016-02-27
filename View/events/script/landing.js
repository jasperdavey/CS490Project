
function sayHello(){
    var user = document.forms["login_form"]["user"].value;
    var pass = document.forms["login_form"]["pass"].value;
    document.forms["login_form"]["user"].value = "";
    document.forms["login_form"]["pass"].value = "";

}
