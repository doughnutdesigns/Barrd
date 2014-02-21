<?php

/* === MAILCHIMP API SETTINGS === */
require_once('MCAPI.class.php');

// Retieve your list ID from http://admin.mailchimp.com/lists/
$list_id = "ea8d88ea24";

// Retrieve API key from: http://admin.mailchimp.com/account/api/
$api = new MCAPI('71a1679c6c12d68ce63864bb5ff3304c-us7');

// Message to display when user has successfully signed up
$success_msg = "Signup successful! Check your email to confirm signup.";

if($_GET['action'] == 'signup'){
	
	$email = $_POST['signup-email'];
	
	if(empty($email)){  
        $status = "error";  
        $message = "Please enter an email address"; 
    }
	if($api->listSubscribe($list_id, $email, '') === true) {
		// Success!	
		$status = 'success';
		$message = $success_msg;
	}else if (empty($email)){  
        $status = "error";  
        $message = "Please enter an email address"; 
    }else{
		// An error ocurred, return error message	
		$status = 'error';
		$message=$api->errorMessage;
	}
	
	$data = array(  
        'status' => $status,  
        'message' => $message  
 );  
  
echo json_encode($data);   
exit; 
}  

?>