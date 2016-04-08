// HTTP request


function makeRequest(params){
    var url = "/~tr88/events/php/controller.php";
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

//get userinfo
function getUserInfo(){
  var command = 9;
  var params = "command="+command;
  var response = makeRequest(params);
  console.log("getting user info");
  console.log(response);
  return response;
}


function getRecommendedEvents(){
    var command = 8;
    var params = "command="+command;
    var response = makeRequest(params);
    console.log("recommended events: "+response);
    return response;
}

var selectCount=0;
var bio= null;
var userTags;

function displayHashTags(){
  selectCount = 0;
  console.log('test');
  userTags = new Set([]);
  var container = document.getElementById('tag_selection');
  var tags = ['computer science', 'hackaton', 'robotics', 'ieee', 'baseball', 'canoe','test','test','computer science', 'hackaton', 'robotics', 'ieee', 'baseball', 'canoe','test','test'];
  var tag;
  for(var i=0; i < tags.length; i++){
      tag = document.createElement("button");
      tag.style.width="110px";
      tag.style.height="35px";
      tag.style.float="left"
      tag.style.fontSize="8pt";
      tag.innerHTML = '#'+tags[i];
      tag.onclick = function(){addHashTag(container,this);};
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
  newTag.onclick = function(){removeThySelf(container,newTag);};
  container.appendChild(newTag);
  userTags.add(tagName);
  parent.removeChild(tag);
}

function removeThySelf(parent,child){
    var selection_tags = document.getElementById("tag_selection");

    if( confirmDelete(child)){

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

function getTags(){
  var command = 20;
  var params = 'command='+command;

}
