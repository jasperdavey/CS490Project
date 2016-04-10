//sign up
var hashTagHanlder = null;

function initHashTagHandler(){
    hashTagHanlder = new HashTagHanlder();
    hashTagHanlder.displayHashTags();
}

function initSignUpFormHanlder(){
  var email = null;
  var password = null;
  var alpa = /(^[a-zA-Z]{2,})$/;
  var noSpecialChar = new RegExp("^[a-zA-Z][a-zA-Z_.0-9]+$");
  var minLength = /[a-zA-Z0-9~!@#$%^&*()+=-]{6,}/;
  var emailRegEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  var valid = false;
  document.getElementById('sign_up_form_indi').oninput = function( form ){
      var e =  form.srcElement;
      var id = form.srcElement.id;
      validateForm(e,id);
  }

    document.getElementById('sign_up_form_org').oninput = function( form ){
        var e =  form.srcElement;
        var id = form.srcElement.id;
        validateForm(e,id);
      }

    function validateForm(e, id){
      switch (id) {
        case 'lastname':
        case 'firstname':
        case 'organization_name':
          valid = alpa.test(e.value);
          if( !valid ){
            e.style.backgroundColor ='red';
          }else{
            e.style.backgroundColor ='green';
            e.style.color = 'white';
          }
          console.log(valid);
          break;
        case 'username':
        valid = noSpecialChar.test(e.value);
        if( !valid ){
          e.style.backgroundColor ='red';
        }else{
          e.style.backgroundColor ='green';
          e.style.color = 'white';
        }
          break;
        case 'email':
        case 'org_email':
        valid = emailRegEx.test(e.value);
        if( !valid ){
          e.style.backgroundColor ='red';
        }else{
          e.style.backgroundColor ='green';
          e.style.color = 'white';
          email = e.value;
        }
        break;
        case 'email_match':
        email = document.getElementById('email').value;
        if(!email){
          email = document.getElementById('org_email').value;
        }
         if ( email != e.value){
           e.style.backgroundColor ='red';
         }else{
           e.style.backgroundColor ='green';
           e.style.color = 'white';
         }
         break;
         case 'password':
         case 'org_password':
         valid = minLength.test(e.value);
         if ( !valid ){
           e.style.backgroundColor ='red';
         }else{
           e.style.backgroundColor ='green';
           e.style.color = 'white';
         }
         break;
        case 'password_match':
        password = document.getElementById('password').value;
        if (!password){
          password = document.getElementById('org_password').value;
        }
        if ( password != e.value){
          e.style.backgroundColor ='red';
        }else{
          e.style.backgroundColor ='green';
          e.style.color = 'white';
        }
        break;
        default:
      }
    }
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
    if( !( firstname && lastname && username && email && password ) ){
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
    console.log("response: "+response);

    if( response == 200 ){
      window.location.href='/~tr88/events/views/profile_creation.html';
    }else{
      console.log('failed to save info');
    }
}

//sign up
function orgSignUp(){
    console.log('signing up');
    var command = 0.1;
    var redirect_url = "/~tr88/events/views/tag_selection.html";
    var organization = document.forms['sign_up_form_org']['organization_name'].value;
    var email = document.forms['sign_up_form_org']['org_email'].value;
    var password = document.forms['sign_up_form_org']['org_password'].value;

    //form verification
    if( !( organization && email && password) ){
        alert('please fill in all fields');
        return;
    }

    document.forms['sign_up_form_org'].reset();

    // var params = "command="+command
    //   +"&"+"organization="+organization
    //   +"&"+"email="+email
    //   +"&"+"password="+password;

    var formData = new FormData();
    formData.append('command',command);
    formData.append('organization',organization);
    formData.append('email',email);
    formData.append('password',password);

    var response = makeRequest(formData);
    console.log("response: "+response);

    if(response == 200 ){
      window.location.href=profile_creation;
    }else{
      alert("failed to save info");
    }
}




function confirmUserBio(node){
    if( confirm('leave bio empty?') == true ){
        return true;
    }else{
        return false;
    }
}
//TODO
//creat new user
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
    var userInfo = JSON.stringify({'tags':Array.from(userTags),'bio':userBio});
    var formData = new FormData();
    formData.append('command',1);
    formData.append('user_info',userInfo)
    console.log(userInfo);
    var response = makeRequest(formData);
    console.log(response);
    if( response == 200 ){
      window.location.href=dashboard_page;
    }
    // console.log('tags: '+JSON.parse(hashTags).tags);
    // console.log('bio: '+JSON.parse(hashTags).bio);
    // window.location.href=dashboard_page;
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
