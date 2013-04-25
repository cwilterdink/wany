<?php

/*%******************************************************************************************%*/
// SETUP

  error_reporting(-1);
  header("Content-type: text/plain; charset=utf-8");
	require_once './sdk.class.php';


/*%******************************************************************************************%*/





//	MAGIC. DO NOT TOUCH.
	// not tested
	$secret = "aag25%#!noa@1f";
	$email = $_GET["email"];
	$hash = $_GET["hash"];
	
	if (md5($email.$secret) == $hash) {
		
		$dynamodb = new AmazonDynamoDB();
		$response = $dynamodb->update_item(array(
		    'TableName' => $table_name,
		    'Key' => $dynamodb->attributes(array(
		        'HashKeyElement'  => $email, // "id" column
		    )),
		    'AttributeUpdates' => array(
		        'verified' => array(
		            'Action' => AmazonDynamoDB::ACTION_PUT,
		            'Value'  => array(AmazonDynamoDB::TYPE_STRING => 1)
		        ),

		));		
		
		
		TODO: find username(email) then update that entry to verfied (0 - > 1)
	}
	
	
?>

