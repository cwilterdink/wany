<?php

include 'sdk.class.php';

session_start();
session_regenerate_id();
if(!isset($_SESSION['user']))
{  
	header('Location: index.php');
}
	$id = $_POST['id'];
	
	$email =$_SESSION['user'];
	
		$dynamodb = new AmazonDynamoDB();

		$response = $dynamodb->update_item(array(
			'TableName' => 'userlist',
			'Key' => $dynamodb->attributes(array(
			'HashKeyElement' => $email,
			)),
			'AttributeUpdates' => array(
			'favs' => array(
			'Action' => AmazonDynamoDB::ACTION_ADD,
			'Value' => array(AmazonDynamoDB::TYPE_NUMBER_SET => array($id))
))));



if ($response->isOK())
{
echo '<h1>Congrats!</h1> <p>Your Favorite Has Been Added</p><br>' . PHP_EOL;


}

?>


       <script type='text/javascript'>
    self.close();
    </script>
