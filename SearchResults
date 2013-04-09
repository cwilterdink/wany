

<?php
// does not create database, 

    $search = $_POST["search"];
    //Call database to search for this variable
  
	
	//may not work for everyone. Put credentials getter here
	require_once dirname(dirname(__FILE__)) . '\www\sdk.class.php';

	$dynamodb = new AmazonDynamoDB();
	
	 //currently returns all items under user specified price.
	 // html could be altered to allow users to choose between two prices, above, or below.
	 // need another prompt in html to determine whether searching by price or kind
	 
	 
	 $response = $dynamodb->scan(array(
		'TableName' => 'Activities',
		'ScanFilter' => array(
			'Price' => array(
				'ComparisonOperator' => AmazonDynamoDB::CONDITION_LESS_THAN_OR_EQUAL,
				'AttributeValueList' => array(
					array( AmazonDynamoDB::TYPE_NUMBER => $search )
				)
			)
		) 
	)); 
	/* to be implemeted once search types are implemented into html.
		inside if statements determinine which search to use using GET or POST from previous page
	
	 $response = $dynamodb->scan(array(
		'TableName' => 'Activities',
		'ScanFilter' => array(
			'Price' => array(
				'ComparisonOperator' => AmazonDynamoDB::CONDITION_GREATER_THAN_OR_EQUAL,
				'AttributeValueList' => array(
					array( AmazonDynamoDB::TYPE_NUMBER => $search )
				)
			)
		) 
	)); 
	
	
	--------------------------------
	
		 $response = $dynamodb->scan(array(
		'TableName' => 'Activities',
		'ScanFilter' => array(
			'Price' => array(
				'ComparisonOperator' => AmazonDynamoDB::CONDITION_BETWEEN,
				'AttributeValueList' => array(
					array( AmazonDynamoDB::TYPE_NUMBER => $searchLow, AmazonDynamoDB::TYPE_NUMBER => $searchHigh  )
				)
			)
		) 
	)); 
	
	
	*/
	
	
  
	// prints out all names of results
	// note : Name may need to be changed pending on what field is called in table.
	$response = $response->body->Items->to_array();
	foreach($response as $value){
	echo "<p>". (string) $value->Name->S ."</p>";
}
  ?>
