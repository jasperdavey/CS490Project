<?php

    // Generate test json

    $events = array( 'ACM', 'IEEE', 'NJIT Robotics Club', 'AlcHE' );
    $tags = array( '#CS' => 2, '#ComputerScience' => 5, '#NJIT' => 7 );

    $addUserArray = array( 'command' => 1, 'email' => 'jasperd92', 'password' => 'randompassword',
                           'firstname' => 'Jasper', 'lastname' => 'Davey', 'bio' => 'I like CS',
                           'events' => $events, 'tags' => json_encode( $tags )
    );

    $json_array = json_encode( $addUserArray );

    echo "$json_array";


 ?>
