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
                        <i class="icon-user icon-white">
                        </i> <?php echo (string) $_SESSION['user']?>
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

            echo 'The activity has been deleted.<br>';
            echo '<br><a href="homepage.php" class="btn btn-success btn-large">Return Home</a>'; 
                
        ?>
</div>
</div>
</body>
</html>
