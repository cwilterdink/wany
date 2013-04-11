<!DOCTYPE html>
<html>
  <head>
    <title>WANY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

  <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
  </head>

  
  <body>
  
  
	<?php
	// does not create database, 

    $search = $_POST["search"];
    //Call database to search for this variable
  
	
	//may not work for everyone. Put credentials getter here
	include 'sdk.class.php';

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
	print ($search);
	echo "accessing dynamo";
	
  ?>

 	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php">WANY</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="#">Settings</a></li>
              <li><a href="index.php">Logout</a></li>
            </ul>

          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div><!--/.navbar-->

  
	<div class="container">
	
	
	
	
	
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
	</div> <!--/.container-->

</body>

</html>
