<?php
$uploaddir = '/home/wrg/www/~tr88/uploads/';
$tmp_name = $_FILES['image']['tmp_name'];
$name = $_FILES['image']['name'];

  if(move_uploaded_file( $tmp_name, "$uploaddir$name")){
    echo "moved file";
  }else{
      echo 'failed to move file';
  }
?>
