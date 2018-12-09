<html>
<head>

	<!-- Import CSS -->
  <link rel="stylesheet" href="css/materialize.css" media="screen,projection">
	<link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Let browser know website is optimized for mobile -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

	<title> Summer Project </title>

</head>

<body> 

  <div class="navbar-fixed" style="margin-bottom:20px;">
    <nav class="green darken-3">
      <div class="nav-wrapper container">
        <a href="index.php" class="brand-logo center">HOME TOWN IMMERSION</a>
        <?php 
          if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
              <ul class="right hide-on-med-and-down">
                <li><a href="user_logged_in_home.php">Hello, <?= $_SESSION['first_name'] ?></a><li>
                <li><a href="index.php?end_session=1">Sign Out</a></li>
              </ul>
        <?php
          } else if ($options['index_page']) { ?>
            <ul class="right hide-on-med-and-down">
              <li><a href="index.php">Sign Up</a></li>
              <li><a href="sign_in.php">Log In</a></li>
            </ul>
          <?php } ?>
      </div>
    </nav>
  </div>