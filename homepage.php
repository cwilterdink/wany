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
              <li><a href="createactivity.php"> Submit Activity</a></li>
              <li><a href="#">About</a></li>
              <?php if(	$_SESSION['admin']== "yes")
              {
              	echo '<li><a href="activityverify.php">Verify Activity </a></li>';
              }
              ?>
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
	<!----------------------------------------------------------------------------->

	<div class="container-fluid">
	
		 <div class="row-fluid">
			<div class="span3">
				<div class="well sidebar-nav">
					<ul class="nav nav-list">
					<li class="nav-header"><i class="icon-user"></i> <?php echo (string) $_SESSION['user']?></li>

					<br><br><br><br><br><br> <!--potentially profile picture here-->
					<li class="nav-header">Links</li>
					<li><a href="settings.php">User Settings</a></li>
					<li><a href="favorites.php">My Favorites</a></li>
					<li><a href="createactivity.php">Submit Activity</a></li>

					</ul>
				</div><!--/.well -->
			</div><!--/span-->
		
		<div class="span9">
          <div class="hero-unit">
				<h1><!--<img src="" alt="logo">-->WANY SEARCH</h1>
				<div class="control-group">
					<form action ="SearchResults.php"method="POST">
					
						<div class="controls">
							<select class="span8" type="text" name="search">
								<option value="">$ Your Budget</option>
								<option value="0">$0</option>
								<option value="1">$1</option>
								<option value="5">$5</option>
								<option value="10">$10</option>
								<option value="15">$15</option>
								<option value="20">$20</option>
								<option value="25">$25</option>
								<option value="30">$30</option>
								<option value="35">$35</option>
								<option value="40">$40</option>
								<option value="45">$45</option>
								<option value="50">$50</option>
							</select>
						
						<!--<p>$ <input class="span6" type="text" name="search" placeholder="Your Budget">-->
						<button type="submit" class="btn btn-success">Submit</button></p>
					
						</div>
				</form>
				</div><!--/control-group-->
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
