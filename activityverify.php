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

<div class="container">
<div class="hero-unit">
        <?php

            // Include the SDK
            include 'sdk.class.php';

            /*%******************************************************************************************%*/

            $AWS_KEY = 'AKIAIT7KJRA6VXAUBA7Q';
            $AWS_SECRET_KEY = '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';
    
            $sqs = new AmazonSQS(array('key' => $AWS_KEY,
                                             'secret' => $AWS_SECRET_KEY));

            $queueurl = "https://sqs.us-east-1.amazonaws.com/327865525595/WANY";

            $size = $sqs->get_queue_size($queueurl);

            if($size == 0)
            {
            	echo 'There is nothing to validate! Check again later!';
            }	

            else 
            {
	            $response = $sqs->receive_message($queueurl);

	            $message = (string) $response->body->ReceiveMessageResult->Message->Body;
	            $receipt = (string) $response->body->ReceiveMessageResult->Message->ReceiptHandle;

	            $values_array = explode('|', $message);

	            $name = $values_array[0];
    	        $pricerange = $values_array[1];
	    	    $address = $values_array[2];
	    	    $phone = $values_array[3];
		        $activity = $values_array[4];
		        $url = $values_array[5];

		        echo 'Name: ' . $name;
		        echo '<br>Price Range: ' . $pricerange;
		        echo '<br>Address: ' . $address;
		        echo '<br>Phone Number: ' . $phone;
		        echo '<br>Activity Type: ' . $activity;
		        echo '<br>URL: ' . $url;

		        echo '<form name="input" method="POST">
				<label>Price Value</label>
				<input type="text" name="price">
				<label>Index Value</label>
				<input type="text" name="index">
				<input type = "submit" name = "update" value = "Update" />
				<input type = "submit" name = "delete" value = "Delete" />';

				if (isset($_POST['update'])) 
				{
   					$dynamodb = new AmazonDynamoDB(array('key' => $AWS_KEY,
                                             'secret' => $AWS_SECRET_KEY));
   					$queue = new CFBatchRequest();

   					 $dynamodb->batch($queue)->put_item(array(
                    'TableName' => 'WANY',
                    'Item' => $dynamodb->attributes(array(
                    'Name' => $name, // Primary (Hash) Key
                    'LowHigh' => $pricerange,
                    'Address' => $address,
                    'Phone' => $phone,
                    'Category' => $activity,
                    'URL' => $url,
    				'Index' => $_POST['index'],
    				'Price' => $_POST['price']
                    ))
                    ));
                    
                    $responses = $dynamodb->batch($queue)->send();

                    //$res = $sqs->delete_message($queueurl, $receipt);

                    //header('Location: verifysuccess.php');
   				} 
				else if (isset($_POST['delete'])) 
				{
    				$res2 = $sqs->delete_message($queueurl, $receipt);

    				header('Location: denied.php');
				}

	    	}
	       
	        	


            //echo 'Thank you for submitting your activity! <br>Your request will be processed and added shortly after an admin validates your request.<br>';
            //echo '<br><a href="homepage.php" class="btn btn-success btn-large">Return Home</a>'; 
                
        ?>
</div>
</div>



		
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
