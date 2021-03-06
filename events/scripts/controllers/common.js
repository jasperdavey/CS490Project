// HTTP request

function makeRequest(params){
    var XM = new XMLHttpRequest();
    var url = "/~tr88/events/php/controller.php";
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
      XM.send(params);

    return response;
}

//get userinfo
function getUserInfo(){
  var command = 9;
  // var params = "command="+command;
  var formData = new FormData();
  formData.append('command',command);
  var response = makeRequest( formData );
  console.log("getting user info");
  console.log(response);
  return response;
}


function getRecommendedEvents(){
    var command = 8;
    var formData = new FormData();
    formData.append('command',command);
    var response = makeRequest(formData);
    console.log("recommended events: "+response);
    return response;
}


function HashTagHanlder(){
  var selectCount=0;
  var bio= null;
  var userTags = new Set([]);
  var tags = [];

  this.getTags = function(){
    var command = 20;
    var formData = new FormData();
    formData.append('command',command);
    var response = makeRequest(formData);
    try{
        console.log(response);
        tags = JSON.parse(response).tags;
    }catch(err){
        console.log('failed to get tags');
    }
    return tags;
  }

  this.displayHashTags = function(){
    selectCount = 0;
    var container = document.getElementById('tag_selection');
    var tags = this.getTags();
    if(!tags){
        tags = [];
    }
    var tag;
    for(var i=0; i < tags.length; i++){
        tag = document.createElement("button");
        tag.style.width="110px";
        tag.style.height="35px";
        tag.style.float="left"
        tag.style.fontSize="8pt";
        tag.innerHTML = tags[i];
        tag.onclick = function(){ addHashTag(container,this);};
        container.appendChild(tag);
    }
  }

    function addHashTag(parent,tag){
    console.log('adding tag: '+tag.innerHTML);
    var container = document.getElementById('selected_tags');
    var tagName = tag.innerHTML;
    var newTag = document.createElement("button");
    newTag.style.width="110px";
    newTag.style.height="35px";
    newTag.style.fontSize="8pt";
    newTag.style.float="left"
    newTag.innerHTML = tagName;
    newTag.onclick = function(){ removeThySelf(container,newTag);};
    container.appendChild(newTag);
    userTags.add(tagName);
    parent.removeChild(tag);
  }


  function removeThySelf(parent,child){
      var selection_tags = document.getElementById("tag_selection");

      if(confirmDelete(child)){
          parent.removeChild(child);
          userTags.delete(child.innerHTML);
          console.log(userTags.size);
      }
  }

  function confirmDelete(node){
      var yes;
      var tag = node.innerHTML;
      if( confirm('remove ' +tag+' ?') == true ){
          return true;
      }else{
          return false;
      }
  }

  this.getUserTags = function(){
    var tagArray = [];
    userTags.forEach( function(value,set){ tagArray.push(value)})
    return tagArray;
  }

  this.resetVars = function(){

  }


}
