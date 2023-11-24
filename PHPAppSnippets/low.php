<?php

if( isset( $_GET[ 'Login' ] ) ) {
	// Get username
	$user = $_GET[ 'username' ];

	// Get password
	$pass = $_GET[ 'password' ];
	$pass = hash('sha256', $pass );

	// Check the database
	$query  = "SELECT * FROM users WHERE user = :user AND password = :pass;";
	$stmt = $this->conn->prepare($query);
	$stmt->bind_param(":user", $user);
	$stmt->bind_param(":pass", $pass);
	$stmt->execute();
	//$result = mysqli_query($GLOBALS["_mysqli_ston"],  $query ) or die( '<pre>' . ((isobject($GLOBALS["mysqli_ston"])) ? mysqli_error($GLOBALS["_mysqliston"]) : (($mysqli_res = mysqli_connect_error()) ? $_mysqli_res : false)) . '</pre>' );

	$result = $stmt->store_result();

	if( $result && mysqli_num_rows( $result ) == 1 ) {
		// Get users details
		$row    = mysqli_fetch_assoc( $result );
		$avatar = $row["avatar"];

		// Login successful
		$html .= "<p>Welcome to the password protected area {$user}</p>";
		$html .= "<img src="{$avatar}" />";
    }
	else {
		// Login failed
		$html .= "<pre><br />Username and/or password incorrect.</pre>";
	}

	((isnull($mysqli_res = mysqli_close($GLOBALS["_mysqliston"]))) ? false : $mysqli_res);
}

?>
