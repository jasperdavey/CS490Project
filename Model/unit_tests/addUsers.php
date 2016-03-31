<?php



    $url = "https://web.njit.edu/~jmd57/backend.php";

    $events = array( 'ACM', 'IEEE', 'NJIT Robotics Club', 'AlcHE' );

    $addUserArray = array( 'command' => 1, 'email' => 'jasperd92', 'password' => 'randompassword',
                           'firstname' => 'Jasper', 'lastname' => 'Davey', 'bio' => 'I like CS',
                           'events' => $events
    );

    $json_array = json_encode( $addUserArray );

    echo "$json_array";

    requestBackend( );

    function requestBackend( )
    {
        // Return Results

        $data = "json=$json_array";
    	$ch = curl_init( );
    	curl_setopt( $ch, CURLOPT_URL, $url );
    	curl_setopt( $ch, CURLOPT_POST, 1 );
    	curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
    	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
    	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    	$sendToCaller = curl_exec( $ch );
    	curl_close( $ch );

        echo "$sendToCaller";
    }

 ?>
