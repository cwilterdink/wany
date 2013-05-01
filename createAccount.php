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
			display:none;
			text-align:center;
			margin: 0 auto;
		}
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
              <li><a href="index.php">Home</a></li>
              <li class = "active"><a href="createAccount.php">Create Account</a></li>
<li><a href="passwordRecovery.php">Forgot Password</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>
</div>




	<div class="container">
		<h1>Create Your WANY Account</h1>
		<form name="input" action="ses.php" method="POST">
			<label>First name</label>
			<input type="text" name="firstname">
			<label>Last name</label>
			<input type="text" name="lastname">
			<label>Email</label>
			<input type="text" name="email">
			<label>Password</label>
			<input type="password" name="password" id = "pw1">
			<label>Re-enter Password</label>
			<input type="password" name="reenter" id = "pw2" onkeyup ="chkpassword()">

			<br>
			<button type="submit" class="btn btn-success">Submit</button>
		</form>
	</div>
	
	
	<!------------------------------ALERT-------------------------------------------------->

	<div id="passwordAlert">
		
		<div class="alert fade in alert-block alert-error">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>WARNING!</strong> Both Passwords Must Match.<br>
		</div>
		
	</div>



<!-------------SCRIPTS!!:D------------------------------------------------------------>


	<script>
	function chkpassword() {

			var p1 = document.getElementById("pw1").value;
			var p2 = document.getElementById("pw2").value;

		 
				document.getElementById("passwordAlert").style.display = 'none';

				if(p1===p2)
				{
					document.getElementById("passwordAlert").style.display = 'none';

				} else 
				{
					document.getElementById("passwordAlert").style.display = 'block';
			
				}

			 

	}
	</script>


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
