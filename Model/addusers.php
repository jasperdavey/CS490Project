<?php
	$id = $_POST['user_id'];
	$password = $_POST['password'];

	$user = mysql_connect('sql.njit.edu', 'jmd57', 'owypHuH4g');
	if (!$user) {
		die('Could not connect: ' . mysql_error());
	}

	if (!mysql_select_db('jmd57', $user)) {
		die('Could not select database');
	}

	$sql = sprintf("INSERT INTO Users (_username, _password) VALUES ('%s',
	'%s')", mysql_real_escape_string($id),
	mysql_real_escape_string($password));

	$result = mysql_query($sql, $user);

	if(!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}

	echo "User $id added to database";
?>
