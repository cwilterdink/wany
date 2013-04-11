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
          //  header("Content-type: text/plain; charset=utf-8");

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

            if($pw1 !== $pw2) {
                echo '<h3>The two password entries do not match.</h3><br>';
                echo '<br><a href="createAccount.php" class="btn btn-warning btn-large">Go Back</a>';
            }
            else {
                echo 'Thank you for signing up! A confirmation email has been sent to you.<br>';
                echo '<br><a href="index.php" class="btn btn-success btn-large">Return Home</a>';

                $autoSubject = "Hello from WANY!";
                $autoBody = "Greetings ";// . $fname . ' ' . $lname . ', from WANY!';


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

            }
        ?>
	</div>
	</div>
 </body>
</html>