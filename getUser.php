<?php 


include "config.php";
include "auth.php";
//session_start();

if( isset( $_SESSION["user_session"] ) ){ 

	$id = $_SESSION["user_session"];

	$data = array();
	
	$conn = new mysqli( $SERVE_NAME, $DB_USER, $DB_PASS );
	$qry = $conn->prepare( "select * from users where user_id"  );	
	$qry->bind_params($username);
	$qry->execute();
	$result = $qry->get_result();
	while( $row = $result->fetch_assoc() ) { 
		data += array(
			"profile_picture"=>$row["profile_picture"],
			"username"=> $row["username"] ,
			"email"=> $row["email"],
			"full_name"=> $row["full_name"]
		);
	}
	
	
}
	


