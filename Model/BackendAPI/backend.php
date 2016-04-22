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
        die( 'Could not connect: ' . mysql_error( ) );
    }

    // select database
    if ( !mysql_select_db( $databaseName, $connection ) )
    {
        die( 'Could not select database' );
    }

    // get JSON from POST
    $json = $_POST[ 'json' ];
    $result = json_decode( $json );
    //echo $result;

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
        include 'createFriendRequest.php';
    }
    // Query recommendations DONE
    elseif ( $result->command == 8 )
    {
        include 'returnRecommendations.php';
    }
    // Return all user info DONE
    elseif ( $result->command == 9 )
    {
        include 'returnUserInfo.php';
    }
    // Add user to event DONE
    elseif ( $result->command == 10 )
    {
        include 'updateUserEvent.php';
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
    elseif ( $result->command == 14 )
    {
        include 'removeUserTag.php';
    }
    // Accept friend request
    elseif ( $result->command == 15 )
    {
        include 'acceptFriendRequest.php';
    }
    elseif ( $result->command == 16 )
    {
        include 'returnAllUsers.php';
    }
    elseif ( $result->command == 17 )
    {
        include 'updateEventTags.php';
    }
    elseif ( $result->command == 18 )
    {
        include 'removeEventTag.php';
    }
    elseif ( $result->command == 19 )
    {
        include 'updateUserUsername.php';
    }
    elseif ( $result->command == 20 )
    {
        include 'removeUserEvent.php';
    }
    elseif ( $result->command == 21 )
    {
        include 'updateUserPassword.php';
    }
    elseif ( $result->command == 22 )
    {
        include 'updateUserFirstname.php';
    }
    elseif ( $result->command == 23 )
    {
        include 'updateUserLastname.php';
    }
    elseif ( $result->command == 24 )
    {
        include 'updateUserEmail.php';
    }
    elseif ( $result->command == 25 )
    {
        include 'updateEventStartDateTime.php';
    }
    elseif ( $result->command == 26 )
    {
        include 'updateEventEndDateTime.php';
    }
    elseif ( $result->command == 27 )
    {
        include 'updateEventName.php';
    }
    elseif ( $result->command == 28 )
    {
        include 'updateEventLocation.php';
    }
    elseif ( $result->command == 29 )
    {
        include 'updateEventBio.php';
    }
    elseif ( $result->command == 30 )
    {
        include 'returnPastEvents.php';
    }
    elseif ( $result->command == 31 )
    {
        include 'returnFutureEvents.php';
    }
    elseif ( $result->command == 32 )
    {
        include 'returnEventInfo.php';
    }
    elseif ( $result->command == 33 )
    {
        include 'returnAllEvents.php';
    }
    elseif ( $result->command == 34 )
    {
        include 'returnUserFriend.php';
    }
    elseif ( $result->command == 35 )
    {
        include 'rejectFriendRequest.php';
    }
    elseif ( $result->command == 36 )
    {
        include 'removeUserFriend.php';
    }
    elseif ( $result->command == 37 )
    {
        include 'deleteUser.php';
    }
    elseif ( $result->command == 38 )
    {
        include 'deleteEvent.php';
    }
    elseif ( $result->command == 39 )
    {
        include 'updateComment.php';
    }
    elseif ( $result->command == 40 )
    {
        include 'returnComments.php';
    }
    elseif ( $result->command == 41 )
    {
        include 'deleteComment.php';
    }
    else
    {
        // Error 404
        echo '{"status":404,"message":"Command not known"}';
    }

    $connection->close();
 ?>
