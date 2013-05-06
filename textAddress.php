<?php

include 'sdk.class.php';

session_start();
session_regenerate_id();
if(!isset($_SESSION['user']))
{  
	header('Location: index.php');
}


	$address = $_POST['address'];
	echo $address;
	
	$username = $_SESSION['user'];
	
	$dynamodb = new AmazonDynamoDB();

	$response = $dynamodb->scan(array(
		'TableName' => 'userlist',
		'ScanFilter' => array(
			'user' => array(
				'ComparisonOperator' => AmazonDynamoDB::CONDITION_EQUAL,
				'AttributeValueList' => array(
						array( AmazonDynamoDB::TYPE_STRING => $username)
				)
			
			)	
	)));

	if($response->isOK())
	{
		
	
		$AWS_KEY ='AKIAIFZS3TDJQRB4TEZQ';
		$AWS_SECRET_KEY ='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';
		
		$sns = new AmazonSNS(array( 'key' => $AWS_KEY, 'secret' => $AWS_SECRET_KEY ));
	
		$phone = (string)$response->body->Items->Phone->{AmazonDynamoDB::TYPE_STRING};
		$topic_ARN_WANY = 'arn:aws:sns:us-east-1:349573786607:';
		$topic_ARN_user = (string)($topic_ARN_WANY . $phone);

		
		$response2 = $sns->publish(
			$topic_ARN_user,
			$address,
			array(
				'Subject' => $address
			)
		);
		if($response2->isOK())
		{
			echo '<br>Text Message Sent';
		}
	}

?>


       <script type='text/javascript'>
    self.close();
    </script>
