//sign up
var hashTagHanlder = null;

function initHashTagHandler(){
    hashTagHanlder = new HashTagHanlder();
    hashTagHanlder.displayHashTags();
}
function indiSignUp(){
    console.log('signing up');
    var command = .1;
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

    var formData = new FormData();

    formData.append('command',command);
    formData.append('firstname',firstname);
    formData.append('lastname',lastname);
    formData.append('username',username);
    formData.append('email',email);
    formData.append('password',password);

    var response = makeRequest(formData);
    try{
        var jsonObject = JSON.parse(response);
        if(jsonObject.status == 200 ){
            window.locaiton.href='/~tr88/events/profile_creation.html';
        }
    }catch(err){
        console.log('failed to parse response');
    }
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




function confirmUserBio(node){
    if( confirm('leave bio empty?') == true ){
        return true;
    }else{
        return false;
    }
}
//TODO
//send user info to back end
function setUserInfo(){
    var userBio = document.getElementById('user_bio').value;
    var userTags = hashTagHanlder.getUserTags();
    if( userTags.size <= 0){
        alert("please select atleast 1 tag");
        return;
    }
    if(userBio.length <= 0 ){
        if( !confirmUserBio()){
            return;
        }
    }
    var hashTags = JSON.stringify({'tags':Array.from(userTags),'bio':userBio});
    console.log(hashTags);
    console.log('tags: '+JSON.parse(hashTags).tags);
    console.log('bio: '+JSON.parse(hashTags).bio);
    window.location.href=dashboard_page;
}

function replacer(){
    tags = userTags.entries();
    values='';
    for (i=0; i < tags.size; i++){
        tags+=values[i];
        if( i < tags.size -1 ){
            tags+=' ,';
        }
    }
    return values;
}
