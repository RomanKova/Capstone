<?php 

include "config.php";


// params given
if(
	isset( $_POST["site_name"] )
){ 
	$conn = new mysqli( $SERVE_NAME, $DB_USER, $DB_PASS );
	
	$site_data = array();
	
	$qry = $conn->prepare( "select * from sites where site_name = ?" );
	$qry->bind_params( "s", $_POST["site_name"]);
	$qry->execute();	
	$result = $qry->get_result();
	while( $row = $result->fetch_assoc() ) { 
		$site_data += array(
			"site_id" => $row["app_id"],
			"site_name" => $row["site_name"],
			"image_name" => $row["image_name"],
			"design_guideline" => $row["design_guideline"], 
			"developer_name" => $row["developer_name"],
			"site_description" => $row["site_description"], 
			"rating" => $row["rating"], 
			"amount_of_ratings" => $row["amount_of_ratings"]
		);		
	}
	echo json_encode( $site_data );
	
}

// no params given 
else{ 
	$conn = new mysqli( $SERVE_NAME, $DB_USER, $DB_PASS );	
	
	$site_data = array();
	
	$qry = $conn->prepare( "select * from ?" );
	$qry->bind_params("s", "sites");
	$qry->execute();	
	$result = $qry->get_result();
	while( $row = $result->fetch_assoc() ) { 
		$site_data += array(
			"site_id" => $row["app_id"],
			"site_name" => $row["site_name"],
			"image_name" => $row["image_name"],
			"design_guideline" => $row["design_guideline"], 
			"developer_name" => $row["developer_name"],
			"site_description" => $row["site_description"], 
			"rating" => $row["rating"], 
			"amount_of_ratings" => $row["amount_of_ratings"]
		);		
	}
	echo json_encode( $site_data );
}

