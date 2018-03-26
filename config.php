<?php 

function genToken($length = 255) {
	
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;

}

															
															
$SERVE_NAME = "localhost";
$DB_USER    = "root";
$DB_PASS    = "";
$DB         = "UXNEXUS";



