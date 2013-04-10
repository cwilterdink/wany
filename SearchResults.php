<!DOCTYPE html>
<html>

<?php
// does not create database, 

    $search = $_POST["search"];
    //Call database to search for this variable
  
	
	//may not work for everyone. Put credentials getter here
	require_once dirname(dirname(__FILE__)) . '..\awstest\sdk.class.php';

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
	
 
	
  ?>


  <div class="navbar">
    <div class="navbar-inner">
      <a class="brand" href="#">Username</a>
      <ul class="nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#">Logout</a></li>
      </ul>
    </div>
  </div>

  <body>
    <h3><img src="" alt="logo">WANY

  <form action="SearchResults.php" method="post">
    Search: <input type="text" name="search"><br>
    <input type="submit" value="Submit"><br>
  </form>
  
</h3>

  

<?php foreach ($response->body->Items as $value) : ?>
	<ul>
		<li> <?php echo (string) $value->Name->{AmazonDynamoDB::TYPE_STRING} ?>
			<ul>
			<li> <?php echo "Price: " ?> <?php echo "$" ?> <?php echo (string) $value->Price->{AmazonDynamoDB::TYPE_NUMBER} ?> 
			<li> <?php echo "Activity Type: " ?> <?php echo (string) $value->Type->{AmazonDynamoDB::TYPE_STRING} ?>
			</ul>
		</li>
	</ul>
<?php endforeach; ?>				




</html>
