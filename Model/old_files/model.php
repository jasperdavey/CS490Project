<?php
	# Created by Jasper Davey

	$id = $_POST['user_id'];
	$password = $_POST['password'];
	$status = 0;
	$userObject = [];

	$user = mysql_connect('sql.njit.edu', 'jmd57','owypHuH4g');
	if (!$user) {
		die('Could not connect: ' . mysql_error());
	}

	if (!mysql_select_db('jmd57', $user)) {
	    die('Could not select database');
	}

	$sql = sprintf("SELECT * FROM Users WHERE _username = '%s'",
	mysql_real_escape_string($id));

	$result = mysql_query($sql, $user);

	// Debug query in case of error
	if (!result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $sql;
		die($message);
	}

	// Case if given wrong username
	if(mysql_num_rows($result) == 0 ) {
		$status = 404;
	}

	// If username found, check if password given is password on database
	while ($row = mysql_fetch_assoc($result)){
		if( $row['_password'] != $password ) {$status = 304;}
		else { $status = 200; }
		$userObject = array( 'username' => $row['_username'] );
	}

	$status_array = array( 'status' => $status, 'user' => $userObject );

	$reponseURL =
	"https://web.njit.edu/~aml35/login/reportingBackToFrontEnd.php";
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $responseURL );
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $status_array );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_exec( $ch );
	curl_close( $ch );

	echo json_encode($status_array);

	mysql_free_result($result);
?>
