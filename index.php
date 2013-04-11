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
              <li><a href="createAccount.php">Create Account</a></li>
              <li><a href="passwordRecovery.php">Forgot Password</a></li>
            </ul>
			  <form action ="loading.php" method = "post" class="navbar-form pull-right">
              <input class="span2" type="text" name="user" placeholder="Username">
              <input class="span2" type="password" name="pword" placeholder="Password">
              <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div><!--/ .navbar-->

	<div class="container">
		<div class="hero-unit">
			<h1>Bored and on a Budget?</h1> 
			<h2>WANY can help you!</h2>
			<p><a href="createAccount.php" class="btn btn-primary btn-large">Sign Up Now! &raquo;</a></p>
			<p>Enjoy life without breaking the bank.</p>
		</div>

    </div> <!-- /container -->



	<!------------------------------------------------------------------------->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
