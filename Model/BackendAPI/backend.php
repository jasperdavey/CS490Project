<?php
    $databaseName = "NJITEventsApp";
    $serverName = 'sql.njit.edu';
    $userName = 'jmd57';
    $password = 'owypHuH4g';

    // create connection
    $connection = mysql_connect( $serverName, $userName, $password );
    if ( !$connection )
    {
        die(' Could not connect: ' . mysql_error( ) );
    }

    // select database
    if ( !mysql_select_db( $databaseName, $connection ) )
    {
        die( 'Could not select database' );
    }

    // get JSON from POST
    $json = $_POST['json'];
    $result = json_decode( $json, true );

    // Create User DONE
    if ( $result->command == 1 )
    {
        include 'createUser.php';
    }
    // Authenticate User DONE
    elseif ( $result->command == 2 )
    {
        include 'authenticateUser.php';
    }
    // Create Event DONE
    elseif ( $result->command == 3 )
    {
        include 'createEvent.php';
    }
    // Create Comment
    elseif ( $result->command == 4 )
    {
        include 'createComment.php';
    }
    // Update User bio
    elseif ( $result->command == 5 )
    {
        include 'updateUserBio.php';
    }
    // Update User tags DONE
    elseif ( $result->command == 6 )
    {
        include 'updateUserTags.php';
    }
    // Update User friends
    elseif ( $result->command == 7 )
    {
        include 'updateUserFriends';
    }
    // Query recommendations TO-DO
    elseif ( $result->command == 8 )
    {
        include 'recommendations.php';
    }
    // Return all user info DONE
    elseif ( $result->command == 9 )
    {
        include 'returnUserInfo.php';
    }
    else
    {
        // Error 404
    }

    $connection->close();

 ?>