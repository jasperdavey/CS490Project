<?php
    // Author: Jasper Davey

    $databaseName = "jmd57";
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
    $json = $_POST[ 'json' ];
    $result = json_decode( $json );

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
    // Add User friends DONE
    elseif ( $result->command == 7 )
    {
        include 'addUserFriends.php';
    }
    // Query recommendations DONE
    elseif ( $result->command == 8 )
    {
        include 'recommendations.php';
    }
    // Return all user info DONE
    elseif ( $result->command == 9 )
    {
        include 'returnUserInfo.php';
    }
    // Add user to event
    elseif ( $result->command == 10 )
    {
        include 'updateUserEvents.php';
    }
    // Return all tags ( Needs to be per populated )
    elseif ( $result->command == 11 )
     {
        include 'returnAllTags.php';
    }
    // Return search results
    elseif ( $result->command == 12 )
    {
        include 'search.php';
    }
    // Return all events friends are going to
    elseif ( $result->command == 13 )
    {
        include 'returnAllFriendsEvents.php';
    }
    // Remove a user tag
    elseif ( $result->command = 14 )
    {
        include 'removeUserTag.php';
    }
    elseif ( $result->command = 15 )
    {
        echo "HERE";
        include 'acceptFriendRequest.php';
    }
    else
    {
        // Error 404
        echo '{"status":404,"message":"Command not known"}';
    }

    $connection->close();

 ?>
