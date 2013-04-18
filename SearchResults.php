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
  
  


 	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="homepage.php">WANY</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="homepage.php">Home</a></li>
              <li><a href="#">Settings</a></li>
              <li><a href="homepage.php">Logout</a></li>
            </ul>

          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div><!--/.navbar-->

  
	<div class="container">
	
	<?php
	// does not create database, 

    $search = $_POST["search"];
    //Call database to search for this variable
	
	//may not work for everyone. Put credentials getter here
	include 'sdk.class.php';

	
	
	$AWS_KEY = 'AKIAIT7KJRA6VXAUBA7Q';
    $AWS_SECRET_KEY = '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';
	
	
	
	
	$dynamodb = new AmazonDynamoDB(array('key' => $AWS_KEY,
                                             'secret' => $AWS_SECRET_KEY));
	
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
<!------------------------------------------------------------------------------------------------------->		
	<div class="span10">
          <div class="hero-unit">
				<h1><!--<img src="" alt="logo">-->WANY SEARCH</h1>
				<div class="control-group">
					<form action ="SearchResults.php"method="POST">
				<!--	<label class="control-label" for="password">Budget   -->
						<div class="controls">
						<!--	<select class="span2" name="budget" id="budget">
								<option></option>
								<option value="01">$0</option>
								<option value="02">$1</option>
								<option value="03">$5</option>
								<option value="04">$10</option>
								<option value="05">$15</option>
								<option value="06">$20</option>
								<option value="07">$25</option>
								<option value="08">$30</option>
								<option value="09">$35</option>
								<option value="10">$40</option>
								<option value="11">$45</option>
								<option value="12">$50+</option>
							</select>
						-->
						<p>$ <input class="span6" type="text" name="search" placeholder="Your Budget">
						<button type="submit" class="btn btn-success">Submit</button></p>
					</label>
						</div>
				</form>
				</div><!--/control-group-->

		
		
<!-------------------------------------------------------------------------------------------------->
	
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


	</div><!--/hero-->
	</div><!--/span-->
	
	</div> <!--/.container-->

</body>

</html>
