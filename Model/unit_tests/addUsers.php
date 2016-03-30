<?php



    $url = "http://web.njit.edu/~jmd57/backend.php";

    $events = array( 'ACM', 'IEEE', 'NJIT Robotics Club', 'AlcHE' );

    $addUserArray = array( 'email' => 'jasperd92', 'password' => 'randompassword',
                           'firstname' => 'Jasper', 'lastname' => 'Davey', 'bio' => 'I like CS',
                           'events' => $events
    );

    $json_array = json_encode( $addUserArray );

    requestBackend( );

    function requestBackend( )
    {
        // Return Results

    	$ch = curl_init();
    	curl_setopt( $ch, CURLOPT_URL, $url );
    	curl_setopt( $ch, CURLOPT_POST, 1 );
    	curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_array );
    	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
    	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    	$result = curl_exec( $ch );
        echo $result;
    	curl_close( $ch );
    }

 ?>
