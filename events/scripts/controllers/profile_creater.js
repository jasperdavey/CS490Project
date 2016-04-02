var selectCount=0;
var bio= null;
var userTags;

function displayHashTags(){
  selectCount = 0;
  userTags = new Set([]);
  var container = document.getElementById("tag_selection");
  var tags = ['computer science', 'hackaton', 'robotics', 'ieee', 'baseball', 'canoe','test','test'];
  var tag;
  for(var i=0; i < tags.length; i++){
      tag = document.createElement("button");
      tag.style.width="100px";
      tag.style.height="35px";
      tag.style.float="left"
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
  newTag.style.width="100px";
  newTag.style.height="35px";
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
    if( userTags.size <= 0){
        alert("please select atleast 1 tag");
        return;
    }
    if(userBio.length <= 0 ){
        if( !confirmUserBio()){
            return;
        }
    }
    console.log(userBio);
    userTags.forEach(function(value){
        console.log(value);
    })
}
