<?php
session_start();
include_once 'login.php';

$user_id = $_POST['user_id'];
$password= $_POST['pass'];
$arg= $_POST['arg'];

$_SESSION['user_id'] = $user_id;
$_SESSION['password'] = $password;
$_SESSION['logged_in'] = false;


if( isset($user_id,$password)){
    login();
}

if( $_SESSION['logged_in'] ){
    echo " ".$_SESSION['logged_in'];
}

/*
$_SESSION['logged_in']=false;
$_SESSION['user_id']=null;


if( _isset( $user_id, $password) && !$_SESSION['logged_in']){
    echo "not logged in";
}
*/

?>
