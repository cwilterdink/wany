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
              <li><a href="homepage.php">Home</a></li>
              <li><a href="createAccount.php">Create Account</a></li>
              <li class="active"><a href="passwordRecovery.php">Forogot Password</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<div class="container">
		<h1>Oops! </h1>
		<h3>Forgot your password?</h3>

		<form name = "input" action = "" method="get">
			<label class="control-label"  for="username">Email</label>
			<input type="text" name = "emailAddress"> 
			<button type="submit" class="btn btn-success">Submit</button>
		</form>
	</div>

	<!------------------------------------------------------------------------->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	

</body>
</html>