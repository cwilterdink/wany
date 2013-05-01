<!DOCTYPE html>
<html lang="en">
<head>
    <title>WANY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

<style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
	#passwordAlert{
		color: red;
		margin:5px;
		display:none;
		text-align:center;
		background-color:#F5F5F5;
		padding:5px;
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
          <a class="brand" href="index.php">WANY</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="createAccount.php">Create Account</a></li>
              <li><a href="passwordRecovery.php">Forgot Password</a></li>
            </ul>

          </div><!--/.nav-collapse -->
        </div>
      </div>


	  
	<div class="container">
		<div class="span10">
			<div class="hero-unit">
					<?php

						/*%******************************************************************************************%*/
						// SETUP

						 // error_reporting(-1);
						  //header("Content-type: text/plain; charset=utf-8");
							require_once './sdk.class.php';


						/*%******************************************************************************************%*/





						//	MAGIC. DO NOT TOUCH.
							// not tested
							$secret = "aag25%#!noa@1f";
							$email = $_GET["email"];
							$hash = $_GET["hash"];
							
							if (md5($email.$secret) == $hash) {

								$dynamodb = new AmazonDynamoDB();
								
							$response = $dynamodb->update_item(array(
									'TableName' => 'userlist',
									'Key' => $dynamodb->attributes(array(
									'HashKeyElement'  => $email, 
								//	'RangeKeyElement' => $current_time, 
								 )),
										'AttributeUpdates' => array(
											'verified' => array(
													'Action' => AmazonDynamoDB::ACTION_PUT,
													 'Value'  => array(AmazonDynamoDB::TYPE_STRING => "1")
								))));
								
								
							}
							if ($response->isOK())
							{
								echo '<h1>Congrats!</h1> <p>Your email has been verified!</p><br>' . PHP_EOL;
							}
							else
							{
								print_r($response);
							}
							
							
						?>

				<a href="index.php" class="btn btn-large btn-primary pull-right" >Back to Main Page &raquo;</a>
			</div><!--/hero-->
		</div><!--/span-->
	</div><!--/container-->
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