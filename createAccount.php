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
              <li><a href="index.php">Home</a></li>
              <li class = "active"><a href="createAccount.php">Create Account</a></li>
              <li><a href="passwordRecovery.php">Forogot Password</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<div class="container">
		<h1>Create Your WANY Account</h1>

		<form name="input" action="html_form_action.asp" method="get">
			<label>First name</label>
			<input type="text" name="firstname">
			<label>Last name</label>
			<input type="text" name="lastname">
			<label>Email</label> 
			<input type="text" name="email">
			<label>Password</label>
			<input type="password" name="password">
			<label>Re-enter Password</label>
			<input type="password" name="reenter">
			<br>
			<button type="submit" class="btn btn-success">Submit</button>
		</form>

	</div>

	<!------------------------------------------------------------------------->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
</body>
</html>