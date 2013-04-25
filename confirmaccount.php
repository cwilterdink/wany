<?php

/*%******************************************************************************************%*/
// SETUP

  error_reporting(-1);
  header("Content-type: text/plain; charset=utf-8");
	require_once '../sdk.class.php';


/*%******************************************************************************************%*/


$dynamodb = new AmazonDynamoDB();

$tablename = 'userlist';
$first = $_POST["firstname"];
$last = $_POST["lastname"];
$email = $_POST["email"];
$pass = $_POST["password"];
$passcheck = $_POST["reenter"];

//We check to make sure the passwords match
if ($pass == $passcheck)
{
	$usename = $first . $last . $email; // Shouldnt this just be email?
	echo $usename;
	//from here we need to compare to the dynamo table of accounts and passwords
	$scanresponse = $dynamodb->scan(array(
		'TableName'    => 'userlist',
		'ScanFilter'      => array(
			'user' => array(
				'ComparisonOperator' => AmazonDynamoDB::CONDITION_EQUAL,
				'AttributeValueList' => array(
					array( AmazonDynamoDB::TYPE_STRING => $usename )
				)
			),
		)
	));
	//We check to see if a user already exists in the system
	$usercheck = (string) $scanresponse->body->Items->user->{AmazonDynamoDB::TYPE_STRING};
	if ($usercheck != $usename)
	{
		//If there is no user of that name, we create him as a regular user
		$queue = new CFBatchRequest();
		
		//TO DO: make email username, add names in other fields. verfied = 0;
		$dynamodb->batch($queue)->put_item(array(
		'TableName' => 'userlist',
		'Item' => $dynamodb->attributes(array(
			'user'            => $usename,             // Primary (Hash) Key
			'password'          => $pass, 
			'access' => "user"
		))
	));
	
	$responses = $dynamodb->batch($queue)->send();
	header('Location: index.php');

	}
	
	//if so we just return to the create account page
	else
	{
		header('Location: createAccount.php');
	}
	
	
}

//if the passwords don't match we return to the create account page
else
{
	header('Location: createAccount.php');
}

/* EVERYTHING AFTER THIS POINT IS FOR ONCE EVERYTHING ABOVE IS COPIED INTO SES.php

	MAGIC. DO NOT TOUCH.
	
	$secret = "aag25%#!noa@1f";
	$email = $_GET["email"];
	$hash = $_GET["hash"];
	
	if (md5($email.$secret) == $hash) {
		
		$dynamodb = new AmazonDynamoDB();
		
		$scanresponse = $dynamodb->scan(array(
		'TableName'    => 'userlist',
		'ScanFilter'      => array(
			'user' => array(
				'ComparisonOperator' => AmazonDynamoDB::CONDITION_EQUAL,
				'AttributeValueList' => array(
					array( AmazonDynamoDB::TYPE_STRING => $usename )
					)
				),
			)
		));
		
		TODO: find username(email) then update that entry to verfied (0 - > 1)
	}
	
*/	
?>

