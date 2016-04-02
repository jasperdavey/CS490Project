var selectCount=0;
var bio= null;
var userTags= null;

function displayHashTags(){
  selectCount = 0;
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
  newTag.onclick = function(){removeThySelf(container);};
  container.appendChild(newTag);
  parent.removeChild(tag);
}

function removeThySelf(parent){
  parent.removeChild(this);
}
