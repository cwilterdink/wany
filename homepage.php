<!DOCTYPE html>
<html>

  <?php
    $txt="WANY User Homepage";
  ?>

  <div class="navbar">
    <div class="navbar-inner">
      <a class="brand" href="#">Username</a>
      <ul class="nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#">Logout</a></li>
      </ul>
    </div>
  </div>

  <head>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <title><?php echo $txt; ?></title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
  </head>

  <body>
    <h1><img src="" alt="logo">WANY</h1>

  <form action="#" method="post">
    Search: <input type="text" name="search"><br>
    <input type="submit" value="Submit"><br>
  </form>
  
  <?php 
    $search = $_POST["search"];
    //Call database to search for this variable
  ?>
    
  </body>
</html>