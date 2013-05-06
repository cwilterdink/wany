<!DOCTYPE html>
<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['user']))
{	
	header('Location: index.php');
}
?>

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
	
	
	
	<div class="container-fluid">
		<div class="span10">
			 <div class="hero-unit">
	<!--****************************************************************************
					Creates SNS Topic and Subscribes User to SMS 
	************************************************************************************-->
			<?php
				include 'sdk.class.php';
				
				$AWS_KEY ='AKIAIFZS3TDJQRB4TEZQ';
				$AWS_SECRET_KEY ='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';
				$topic_ARN_WANY = 'arn:aws:sns:us-east-1:349573786607:';
				$userName = $_SESSION['user'];
				
				
				$sns = new AmazonSNS(array( 'key' => $AWS_KEY, 'secret' => $AWS_SECRET_KEY ));
				
				$phoneNum = $_POST['phoneNum'];
				
				//Sets Topic Name Using User phonenumber
				$response1 = $sns->create_topic((string)$phoneNum);
				
				$topic_ARN_user = (string)($topic_ARN_WANY . $phoneNum);
				
				//Sets Topic Display Name
				$response2 = $sns->set_topic_attributes(
					$topic_ARN_user,
					'DisplayName',
					'WANY');
				
				//creates subscription to SMS
				$response3 = $sns->subscribe($topic_ARN_user, 'sms', $phoneNum, null);
				
			
			
			//*********************************************************************************
			//--------------- Outputs Success of Topic Creation/Subscription-------------------
			//**********************************************************************************
				
				if($response3->isOK())
				{
					echo '<h1> Thanks For Subscribing to WANY!</h1>';
					echo '<p>A verfication text has been sent to ' . $phoneNum . '</p>';
					echo '<br><a href="homepage.php" class="btn btn-success btn-large">Return Home</a>';
					//***************************************************
					// Adds User Phone Number to Database
					//***************************************************
					$dynamodb = new AmazonDynamoDB();
					$response = $dynamodb->update_item(array(
						'TableName' => 'userlist',
						'Key' => $dynamodb->attributes(array(
							'HashKeyElement'  => $userName, 
						)),
						'AttributeUpdates' => array(
							'Phone' => array(
								'Action' => AmazonDynamoDB::ACTION_PUT,
								'Value'  => array(AmazonDynamoDB::TYPE_STRING => $phoneNum)

							),
							'sns' => array(
								'Action' => AmazonDynamoDB::ACTION_PUT,
								'Value'  => array(AmazonDynamoDB::TYPE_STRING => '1')
							)
						)
					));
					//********************************************************

					
				}
				else
				{
					echo '<h1> Sorry, Something Went Wrong </h1>';
					echo '<p> Please try again. </p>';
					echo '<br><a href="settings.php" class="btn btn-success btn-large">Go Back</a>';
				}
				
			//*************************************************************************************
			?>
				
	<!--**********************************************************************************************-->

			</div><!--/hero-->
		</div><!--/span-->
	</div><!--/row-->
		
	</div><!--/ .container-->
	
	
  <!--  javascript -->
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
