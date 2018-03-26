<?php 

include "config.php";
include "auth.php";
//session_start();

if( 
	isset( $_SESSION["user_id"] )
		&&
	isset( $_POST["site_id"] )
		&&
	isset( $_POST["rating"] )
){ 

	$conn = new mysqli( $SERVE_NAME, $DB_USER, $DB_PASS );
	
	$qry = $conn->prepare( "insert into site_ratings (site_fk, user_fk , rating) values ( ? , ? , ? )" );
	$qry->bind_params( "sss", $_POST["site_id"] , $_SESSION["user_id"], $_POST["rating"] );
	$qry->execute();
	
	$json = array( "success" => "inserted");
	echo json_encode( $json );
	
}
else{ 

	$json = array( "error" => "missing data for rating submition." );
	echo json_encode( $json );

}

