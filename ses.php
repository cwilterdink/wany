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
<li class="active"><a href="homepage.php">Home</a></li>
<li><a href="#">Settings</a></li>
<li><a href="index.php">Logout</a></li>
</ul>

</div><!--/.nav-collapse -->
</div>
</div>
</div><!--/.navbar-->

<div class="container">
<div class="hero-unit">
        <?php

            // Enable full-blown error reporting. http://twitter.com/rasmus/status/7448448829
            error_reporting(-1);

            // Set plain text headers
          // header("Content-type: text/plain; charset=utf-8");

            // Include the SDK
            include 'sdk.class.php';

            /*%******************************************************************************************%*/

            $AWS_KEY = 'AKIAJPUZ6RALJQEBGVGA';
            $AWS_SECRET_KEY = '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';
            $sourceEmail = 'nicel1@tcnj.edu';

            $amazonSes = new AmazonSES(array('key' => $AWS_KEY,
                                             'secret' => $AWS_SECRET_KEY));


            $fname = $_POST["firstname"];
            $lname = $_POST["lastname"];
            $destEmailAddress = $_POST["email"];
            $pw1 = $_POST["password"];
            $pw2 = $_POST["reenter"];
            $secret = "aag25%#!noa@1f";
			$email = urlencode($_POST['email']);
			$hash = MD5($_POST['email'].$secret);
			$link = "http://ec2-54-234-109-54.compute-1.amazonaws.com/wany-master/confirmaccount.php?email=$email&hash=$hash";

            if($pw1 != $pw2) {
                echo '<h3>The two password entries do not match.</h3><br>';
                echo '<br><a href="createAccount.php" class="btn btn-warning btn-large">Go Back</a>';
            }
            if($pw1 == $pw2)
			{
               
// IMPT: Copy paste most of connors code in confirm account here to make an account in his table here
// credentials still need to be fixed here and IAM aswell probably
// add field to existing code setting account to unverified or 0, and 1 for active


                $autoSubject = "Hello from WANY!";
				$autoBody = "Greetings " . $fname . ' ' . $lname . ', from WANY!<br/> ' . "Your Verification Link is : " . $link ;
				
				$dynamodb = new AmazonDynamoDB();

				$tablename = 'userlist';
				$first = $_POST["firstname"];
				$last = $_POST["lastname"];
				$email = $_POST["email"];
				$pass = $_POST["password"];
				$passcheck = $_POST["reenter"];

				//We check to make sure the passwords match
	
				$usename = $email; // Shouldnt this just be email?
			
				//from here we need to compare to the dynamo table of accounts and passwords
				$scanresponse = $dynamodb->scan(array(
				'TableName' => 'userlist',
				'ScanFilter' => array(
				'user' => array(
				'ComparisonOperator' => AmazonDynamoDB::CONDITION_EQUAL,
				'AttributeValueList' => array(
				array( AmazonDynamoDB::TYPE_STRING => $usename )
				)
				),
				)
				));
				
				
				//We check to see if a user already exists in the system
				$usercheck = (string) $scanresponse->body->Items->user->{AmazonDynamoDB::TYPE_STRING};
				if ($usercheck != $usename)
				{
					//If there is no user of that name, we create him as a regular user
					$queue = new CFBatchRequest();

					$dynamodb->batch($queue)->put_item(array(
					'TableName' => 'userlist',
					'Item' => $dynamodb->attributes(array(
					'user' => $usename, // Primary (Hash) Key
					'password' => $pass,
					'access' => "user",
					'verified' => 0,
					'Fname' => $first,
					'Lname' => $last
					))
					));
					
					$responses = $dynamodb->batch($queue)->send();
	
					
					
					
					$emailsend = $amazonSes->send_email(
					$sourceEmail, // Source (aka From)
						array('ToAddresses' => array( // Destination (aka To)
							$destEmailAddress
						)),
						array( // Message (short form)
							'Subject.Data' => $autoSubject,
							'Body.Text.Data' => $autoBody
						)
					);
					echo 'Thank you for signing up! A confirmation email has been sent to you.<br>';
					echo '<br><a href="index.php" class="btn btn-success btn-large">Return Home</a>';

				}
				else
				{
					echo '<h3>This email is already in use.</h3><br>';
					echo '<br><a href="createAccount.php" class="btn btn-warning btn-large">Go Back</a>';
				}
			}	
				
        ?>
</div>
</div>
</body>
</html>
