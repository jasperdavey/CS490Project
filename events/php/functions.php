<?php
/* author: Totaram Ramrattan
  CS490-104-Semester Project
  2/25/16
*/

//make request to middle
function makeRequest($params){
  //angelica's
  $url = "https://web.njit.edu/~aml35/login/commandLine.php";
  $ch = curl_init($url);
  //jasper api
  // $ch = curl_init("https://web.njit.edu/~jmd57/backend.php");
  //local test
  // $ch = curl_init("https://web.njit.edu/~tr88/php/test.php");
  // $ch = curl_init("localhost/events/php/server_test.php");
  $headers = curl_getinfo($ch);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  myLog("curl request: url:".$url.", params: ".$params,false);
  $result = curl_exec($ch);
  curl_close($ch);
  myLog("curl response: ".$result,false);
  return $result;

}

function buildParams(){
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
    return $params;
}

function login($params){
    $response = makeRequest($params);
    $jsonObject = json_decode($response,true);
    $status = $jsonObject["status"];
    if( $status == 200 ){
        $_SESSION['logged_in']=true;
        $_SESSION['id']=$jsonObject['id'];
    }else{
        $_SESSION['logged_in']=false;
        $_SESSION['id']=null;
    }
    myLog("login response: ".$response,false);
    echo $status;
}

function logOut(){

    if( $_SESSION['logged_in']== true){
      session_unset();
      session_destroy();
      $_SESSION['logged_in']=false;
      echo 200;
    }else{
      session_unset();
      session_destroy();
      $_SESSION['logged_in']=false;
      echo 200;
    }
}


function loggedInCheck(){

    if($_SESSION['logged_in'] == true ){
        echo '200';
    }else{
        echo '404';
    }

    // //TODO set back to check
    // echo '200';
}

function createUser($params){
    $response = makeRequest($params);
    $data = json_decode($response,true);
    if( $data['status'] == 200 ){
      $_SESSION['id']=$data['id'];
      $_SESSION['logged_in'] = true;
    }
    echo $response;
}

function createEvent(){
    $info = file_get_contents('php://input');
    $response = makeRequest($info);
    echo $response;
}


function getRecommendedEvents($params){
    if($_SESSION['id'] != null ){
      myLog("getting recommend events withd id: ".$_SESSION['id'],false);
      $response = makeRequest($params."&id=".$_SESSION['id']);
      echo $response;
    }else{
      myLog("failed to get recommended events, params".$params,false);
    }
}

function getAllEvents(){

}


function getUserInfo($params){

  if ( $_SESSION['id'] != null ){
    $response = makeRequest($params."&id=".$_SESSION['id']);
    echo $response;
  }else{
    echo "can't get user info";
  }
}

//get events
function getFutureEvents($params){
    $response = makeRequest($params);
    $jsonObject = json_decode($response,true);
    $eventIDs = $jsonObject['info'];
    $index = 0;
    foreach( $eventIDs as $value){
        $eventIDs[$index] = $value[0];
        $index++;
    }
    $events = array();
    $index = 0;
    foreach ($eventIDs as $value) {
        $params = "command=32&id=".$value;
        $response = makeRequest($params);
        try{
            $jsonObject = json_decode($response,true);
            $event = $jsonObject['info'];
            $events[$index] = $event;
            $index++;
            //add to json object to return
        }catch (Exception $e){
            myLog("failed to get future events - parsing failed",false);
        }
        myLog("event id:".$value." - ".$response,false);
    }

    $jPacket = json_encode($events);
    $jPacket = '{"events":'.$jPacket.'}';
    myLog("json encoded events: ".$jPacket,false);

}


// write debug output to file do not echo
      function myLog($string,$clear){
        global $debug;
        if($debug == false) return;

        $mode = 'a';
        if($clear){
          $mode='w';
        }

        $handle = null;

        if($linux){
            $handle = fopen('/home/wrg/www/~tr88/events/test/php_log.txt',$mode);
        }else{
            $handle = fopen('/Users/wrg/Sites/~tr88/events/test/php_log.txt',$mode);
        }

        if( !$handle ){
          echo 'failed to open log for writing';
        }
        date_default_timezone_set("America/New_York");
        $time = time();
        $date = date('Y-m-d H:i:s',$time);
        fwrite($handle,"\n");
        fwrite($handle,$date."\n");
        fwrite($handle,$string."\n");
        fclose($handle);
      }


?>
