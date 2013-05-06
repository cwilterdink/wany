<!DOCTYPE html>

<html>

<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user']))
{	
header('Location: index.php');
}
?>
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
					<li class="active"><a href="homepage.php"><i class="icon-home icon-white"></i> Home</a></li>
					<li><a href="createactivity.php"> Submit Activity</a></li>
					<li><a href="#">About</a></li>
					</ul>
					<ul class=" nav pull-right dropdown">
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-user icon-white"></i> <?php echo (string) $_SESSION['user']?>
					<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
					<li><a href="settings.php"><i class="icon-wrench"></i> User Settings</a></li>
					<li><a href="favorites.php"><i class="icon-heart"></i> My Favorites</a></li>
					<li class="divider"></li>
					<li><a href="logout.php"><i class="icon-off"></i> Log Out</a></li>
					</ul>
					</li>
					</ul><!--/dropdown-->
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

<!----------------------------------------------------------------------------------------->
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
		'TableName' => 'WANY',
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
		<!--<label class="control-label" for="password">Budget -->
		<div class="controls">
		<!-- <select class="span2" name="budget" id="budget">
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
		</div><!--/hero-->
		<?php foreach ($response->body->Items as $value) : ?>
		
			<table class="table" style="border-top: none">
				<thead class="well">
					<tr>
						<th><?php echo (string) $value->Name->{AmazonDynamoDB::TYPE_STRING} ?>
							<form action="addToFavorites.php" method="post" target ="_blank"> 
							<button type="submit" class="btn pull-right" data-toggle="button tooltip" data-placement="top" title="Favorite"><i class="icon-heart"></i>
							<input type= "hidden" name = "id" value= "<?php echo $value->Index->{AmazonDynamoDB::TYPE_NUMBER};?>" >
							</button>
							</form> 
						</th>
					</tr>
				</thead>
				<tbody class="well" style="background:#FFF; font-size: 8pt">
					<tr>
						<th> <?php echo "Price: " ?> <?php echo (string) $value->LowHigh->{AmazonDynamoDB::TYPE_STRING} ?> </th>
					</tr>
					<tr>
						<th> 
							<?php echo "Address: " ?> <?php echo (string) $value->Address->{AmazonDynamoDB::TYPE_STRING} ?>
							<!--******************************************************************
							--------------------------------TEXT ADDRESS--------------------------
							***********************************************************************-->
							<?php
								$username = $_SESSION['user'];

								$dynamodb_USER = new AmazonDynamoDB();
								
								$responseVER = $dynamodb_USER->scan(array(
									'TableName' => 'userlist',
									'ScanFilter' => array(
										'user' => array(
												'ComparisonOperator' => AmazonDynamoDB::CONDITION_EQUAL,
												'AttributeValueList' => array(
													array( AmazonDynamoDB::TYPE_STRING => $username)
												)
										)
									)	
								));
								
								
								//WILL ONLY DISPLAY TEXT ADDRESSS BUTTON IF USER HAS SUBSCRIBED
								if($responseVER->isOK())
								{
									foreach ($responseVER->body->Items as $value2){
										$valid ='1';
										$verified = (string)$value2->sns->{AmazonDynamoDB::TYPE_STRING};
										//Checks if sns value == 1 to indicate presense of a subscribed number
			
										if (strcmp($verified, $valid) == 0)
										{
											$isVER = true;

											$address = (string)$value->Address->{AmazonDynamoDB::TYPE_STRING};
											echo '<form action="textAddress.php" method="POST" target ="_blank">';
											
											echo '<button type="submit" class="btn pull-right" data-toggle="button tooltip" data-placement="top" title="Text Address"><i class="icon-comment"></i>';
											
											echo '<input type= "hidden" name = "address" value=';
											echo '"' . $address . '"';
											echo '></button></form>';
								
										}
										else
										{
											$isVer = false;
										}
									}
								}
							
							
							?>
					

							
							<!--********************************************************************-->
						</th>
					</tr>
					<tr>
						<th> <?php echo "Phone Number: " ?> <?php echo (string) $value->Phone->{AmazonDynamoDB::TYPE_STRING} ?></th>
					</tr>
					<tr>
						<th> <?php echo "Activity Type: " ?> <?php echo (string) $value->Category->{AmazonDynamoDB::TYPE_STRING} ?></th>
					</tr>
					<tr>
						<th> <?php echo "URL: " ?> <?php echo (string) $value->URL->{AmazonDynamoDB::TYPE_STRING} ?></th>
					</tr>
				</tbody>
			</table>
			<?php endforeach; ?>	


		</div><!--/span-->
	</div> <!--/.container-->
	
	
	
		<!--javascript -->
		

		
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/bootstrap-transition.js"></script>
		<script src="js/bootstrap-alert.js"></script>
		<script src="js/bootstrap-modal.js"></script>
		<script src="js/bootstrap-dropdown.js"></script>
		<script src="js/bootstrap-scrollspy.js"></script>
		<script src="js/bootstrap-tab.js"></script>
		<script src="js/bootstrap-tooltip.js"></script>
		<script src="js/bootstrap-popover.js"></script>
		<script src="js/bootstrap-button.js"></script>
		<script src="js/bootstrap-collapse.js"></script>
		<script src="js/bootstrap-carousel.js"></script>
		<script src="js/bootstrap-typeahead.js"></script>


</body>



</html>
