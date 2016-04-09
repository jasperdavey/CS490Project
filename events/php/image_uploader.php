<?php
$params= '';
$size = count($_POST);
$tracker = 0;
foreach ($_POST as $key => $value){
    $params = $params.$key.'='.$value;
    if( $tracker < $size-1){
        $params = $params.'&';
    }
    $tracker+=1;
}
echo $params;
// $uploaddir = '/home/wrg/www/~tr88/uploads/';
// $tmp_name = $_FILES['image']['tmp_name'];
// $name = $_FILES['image']['name'];
//
//   if(move_uploaded_file( $tmp_name, "$uploaddir$name")){
//     echo "moved file";
//   }else{
//       echo 'failed to move file';
//   }
?>
