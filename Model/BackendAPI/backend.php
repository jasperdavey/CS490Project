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

    // Create User DONE
    switch ( $result->command )
    {
        case 1:
            include 'createUser.php';
            break;
        case 2:
            include 'authenticateUser.php';
            break;
        case 3:
            include 'createEvent.php';
            break;
	    case 4:
            include 'createComment.php';
            break;
	    case 5:
            include 'updateUserBio.php';
            break;
	    case 6:
            include 'updateUserTags.php';
            break;
	    case 7:
        include 'createFriendRequest.php';
            break;
	    case 8:
            include 'returnRecommendations.php';
            break;
	    case 9:
            include 'returnUserInfo.php';
            break;
	    case 10:
            include 'updateUserEvent.php';
            break;
	    case 11:
            include 'returnAllTags.php';
            break;
        case 12:
            include 'search.php';
            break;
        case 13:
            include 'returnAllFriendsEvents.php';
            break;
	    case 14:
            include 'removeUserTag.php';
            break;
	    case 15:
            include 'acceptFriendRequest.php';
            break;
	    case 16:
            include 'returnAllUsers.php';
            break;
	    case 17:
            include 'updateEventTags.php';
            break;
	    case 18:
            include 'removeEventTag.php';
            break;
	    case 19:
            include 'updateUserUsername.php';
            break;
	    case 20:
            include 'removeUserEvent.php';
            break;
	    case 21:
            include 'updateUserPassword.php';
            break;
        case 22:
            include 'updateUserFirstname.php';
            break;
        case 23:
            include 'updateUserLastname.php';
            break;
	    case 24:
            include 'updateUserEmail.php';
            break;
	    case 25:
            include 'updateEventStartDateTime.php';
            break;
	    case 26:
            include 'updateEventEndDateTime.php';
            break;
	    case 27:
            include 'updateEventName.php';
            break;
	    case 28:
            include 'updateEventLocation.php';
            break;
	    case 29:
            include 'updateEventBio.php';
            break;
	    case 30:
            include 'returnPastEvents.php';
            break;
	    case 31:
            include 'returnFutureEvents.php';
            break;
        case 32:
            include 'returnEventInfo.php';
            break;
        case 33:
            include 'returnAllEvents.php';
            break;
	    case 34:
            include 'returnUserFriend.php';
            break;
	    case 35:
            include 'rejectFriendRequest.php';
            break;
	    case 36:
            include 'removeUserFriend.php';
            break;
	    case 37:
            include 'deleteUser.php';
            break;
	    case 38:
            include 'deleteEvent.php';
            break;
	    case 39:
            include 'updateComment.php';
            break;
	    case 40:
            include 'returnComments.php';
            break;
	    case 41:
            include 'deleteComment.php';
            break;
        default:
            echo '{"status":404,"message":"Command not known"}';
            break;
    }

    $connection->close();
 ?>
