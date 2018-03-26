<?php 

include "config.php";


if(
		isset($_POST["full_name"]) 
			&&
		isset($_POST["last_name"])
			&&
		isset($_POST["username"])
			&&
		isset($_POST["email"])
			&&
		isset($_POST["password"])
){ 

		$conn = new mysqli( $SERVE_NAME, $DB_USER, $DB_PASS );

		$fullname = $_POST["full_name"];
		$username = $_POST["username"];
		$email    = $_POST["email"];
		$password = $_POST["password"];
		$session_id = genToken();
		
		$hashed_pass = password_hash( $password, PASSWORD_DEFAULT );

	
		// check for if username already exists
		$usernameTaken = false; 
		$qry = $conn->prepare( "select * from users where username = ?" );	
		$qry->bind_params($username);
		$qry->execute();
		$result = $qry->get_result();
		while( $row = $result->fetch_assoc() ) { 
			if( $row["username"] == $username ){ 
				$usernameTaken = true;
			}
		}
		
		$qry->close();
	
		if( !usernameTaken ){ 
			session_start();
		
			$_SESSION["user_session"] = $session_id;
			
			$qry = ("insert into users (username, email, password, full_name, session_id) values (?,?,?,?,?)");
			$qry->bind_params( "sssss", $username, $email, $hashed_pass, $fullname ,$session_id );
			$qry->execute();
			
			$ins_id = $conn->insert_id; 
			$_SESSION["user_id"] = $ins_id;
			
			$json = array(
				"username"=>$username,
				"email"=>$email,
				"full_name"=>$fullname
			);
			echo json_encode( $json );
		}
		else{ 
			$json = array( "error"=>"username taken" );	
			echo json_encode( $json );
		}
		
	
}	
		



		
	
