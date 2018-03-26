
<?php 
// figure out what to do with the session_start()
// started in an included file and in the service scripts
	session_start();

if(
	isset( $_SESSION["user_id"] )
		&&
	isset( $_SESSION["user_session"] )
){

	$conn = new mysqli( $SERVE_NAME, $DB_USER, $DB_PASS );
	$qry = ("select * from users where user_id = ? and session_id=?");
	$qry->bind_params( "ss", $_SESSION["user_id"] , $_SESSION["user_session"] );
	$qry->execute();
	
	$result = $qry->get_result();
	while( $row = $result->fetch_assoc() ) { 
		if( 
			$row["user_id"] == $_SESSION["user_session"]
				&&
			$row["session_id"] == $_SESSION["user_session"]
		){}
		else{ 
			exit();
		}
	}
	
}
else{ 
	exit();
}



