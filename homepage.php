<!DOCTYPE html>
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
          <a class="brand" href="index.php">WANY</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="#">Settings</a></li>
              <li><a href="index.php">Logout</a></li>
            </ul>

          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

	<div class="container-fluid">
	
		 <div class="row-fluid">
			<div class="span2">
				<div class="well sidebar-nav">
					<ul class="nav nav-list">
					<li class="nav-header">User Profile</li>

					<br><br><br><br><br><br><br> <!--potentially profile picture here-->
					<li class="nav-header">Other</li>
					<li><a href="#">Link</a></li>

					</ul>
				</div><!--/.well -->
			</div><!--/span-->
		
		<div class="span10">
          <div class="hero-unit">
				<h1><!--<img src="" alt="logo">-->WANY SEARCH</h1>
				<div class="control-group">
					<form action ="SearchResults.php"method="POST">
					<label class="control-label" for="password">Budget
						<div class="controls">
							<select class="span2" name="budget" id="budget">
								<option></option>
								<option value="01">$0</option>
								<option value="02">$1</option>
								<option value="03">$5</option>
								<option value="04">$10</option>
								<option value="05">$15</option>
								<option value="06">$20</option>
								<option value="07">$25</option>
								<option value="08">$30</option>
								<option value="09">$35</option>
								<option value="10">$40</option>
								<option value="11">$45</option>
								<option value="12">$50+</option>
							</select>
						<input class="span6" type="text" name="search">
						<button type="submit" class="btn btn-success">Submit</button>
					</label>
						</div>
				</form>
				</div><!--/control-group-->
			</div><!--/hero-->
		</div><!--/span-->
	</div><!--/row-->
		



	</div><!--/ .container-->
  
  <?php 
    $search = $_POST["search"];
    //Call database to search for this variable
  ?>
</body>   
</html>
