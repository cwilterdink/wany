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
	<!----------------------------------------------------------------------------->

	<div class="container-fluid">
	

		
		<div class="span10">
          <div class="hero-unit">
				<h1><i class="icon-wrench"></i>User Settings</h1><br>
				<h2>Subscribe to Texts From WANY</h2>
				<form name="input" action="sns.php" method="POST">
				<label>Phone Number</label>
			<input class="span2" type="text" name="phoneNum" placeholder="ex: 1-732-555-1234">
			<button type="submit" class="btn btn-success">Subscribe</button>
		</form>
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
