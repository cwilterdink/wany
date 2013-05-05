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
<li><a href="#"><i class="icon-heart"></i> My Favorites</a></li>
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



include 'sdk.class.php';



		$AWS_KEY = 'AKIAIT7KJRA6VXAUBA7Q';
			$AWS_SECRET_KEY = '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';


		$accountDB = new AmazonDynamoDB();
		$user = $_SESSION['user'];
		$scanresponse = $accountDB->scan(array(
			'TableName' => 'userlist',
			'ScanFilter' => array(
				'user' => array(
					'ComparisonOperator' => AmazonDynamoDB::CONDITION_EQUAL,
					'AttributeValueList' => array(
						array( AmazonDynamoDB::TYPE_STRING => $user )
					)
				),
			)
		));

		
		if ($scanresponse->isOK())
		{
			$favorites= $scanresponse->body->Items->favs->{AmazonDynamoDB::TYPE_NUMBER_SET};

		}

		$dynamodb = new AmazonDynamoDB(array('key' => $AWS_KEY,
													 'secret' => $AWS_SECRET_KEY));

//currently returns all items under user specified price.
// html could be altered to allow users to choose between two prices, above, or below.
// need another prompt in html to determine whether searching by price or kind

		for ($i =0; $i<sizeof($favorites) ;$i++) :
			/*$response = $dynamodb->scan(array(
				'TableName' => 'WANY',
				'ScanFilter' => array(
					'Index' => array(
						'ComparisonOperator' => AmazonDynamoDB::CONDITION_EQUAL,
						'AttributeValueList' => array(
							array( AmazonDynamoDB::TYPE_NUMBER => $favorites[$i])
						)
					)
				)
			));
			*/
			
			
			$response = $dynamodb->query(array(
				'TableName'    => 'WANY',
				'HashKeyValue' => array(
					AmazonDynamoDB::TYPE_NUMBER => (string)$favorites[$i]
				)
			));
			
			if($response->isOK())
			{

			}
			else
			{
			}

?>


	<?php foreach ($response->body->Items as $value) : 
		
	?>
	
	<table class="table" style="border-top: none">
		<thead class="well">
		<tr>
			<th><?php echo (string) $value->Name->{AmazonDynamoDB::TYPE_STRING} ?>
			
			</th>
		</tr>
		</thead>
		<tbody class="well" style="background:#FFF; font-size: 8pt">
		<tr>
			<th> <?php echo "Price: " ?> <?php echo (string) $value->LowHigh->{AmazonDynamoDB::TYPE_STRING} ?> </th>
		</tr>
<tr>
<th> <?php echo "Address: " ?> <?php echo (string) $value->Address->{AmazonDynamoDB::TYPE_STRING} ?></th>
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
<?php endfor; ?>

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
