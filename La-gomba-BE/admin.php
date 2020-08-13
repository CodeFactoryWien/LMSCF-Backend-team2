<?php
	ob_start();
	session_start();
	require_once 'actions/db_connect.php'; 

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
		header("Location: login/login.php");
		exit;
	}
	if( isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}

	// select logged-in admins details
	$sql = "SELECT * FROM users WHERE user_id=".$_SESSION['admin'];
	$result = mysqli_query($conn, $sql);
	$userRow = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
	<title>LaGomba</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&amp;display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/styles.css">
    <script defer="" src="js/stickyNav.js"></script>
</head>
<body>
  	<header class="wrapper-header" id="top">
        <div class="header-parallax">
            <img src="img/parallax-back.png" id="back-parallax">
            <div class="parallax-title" id="titel-parallax">
                <h1 class="parallax-title-title">
                    LaGomba
                </h1>
                <p class="parallax-title-text">
                    Urban Mushroom
                </p>
                <div class="parallax-title-button">
                    <a style="z-index: 1000;" href="aboutme.php" class="btn btn-white btn- animate">    About me</a>
                </div>
            </div>
        </div>
    </header>
    <nav id="navbar" class="wrapper-nav">
            <div class="nav-links">
                <div class="nav-left">
                    <a href="index.php" class="wrapper-logo">
                        <img class="logo-nav" src="img/logo-body.png" alt="">
                        <img class="logo-nav" src="img/logo-arrow.png" alt="">
                    </a>
                </div>
                <div class="nav-right">
                    <a class="nav-link" href="index.php">
                        <p><b>home</b></p>
                    </a>
                    <a class="nav-link" href="aboutme.php">
                        <p><b>about me</b></p>
                    </a>
                    <a class="nav-link" href="recipes.php">
                        <p><b>recipes</b></p>
                    </a>
                    <div class="nav-link-contact" id="contact-show">
                        <img class="rounded" style="height: 40px; width: 40px" src="<?php echo $userRow['image'];?>">Hi <?php echo $userRow['userName']; ?>
                        <a href="logout.php?logout" class="nav-link  btn btn-outline-warning">Log out</a>
                    </div>
                    <div class="nav-link-contact">
                        <p><a href="login.php"><b>login</b></a></p>
                    </div>
                </div>
            </div>
        </nav>
	
    <div id="result" class="container-fluid row row-cols-1 row-cols-md-2 row-cols-lg-3 mx-auto my-4">
    <?php
		$sql = "SELECT * FROM products";
		$result = mysqli_query($conn, $sql);
		// fetch the next row (as long as there are any) into $row
		while($row = mysqli_fetch_assoc($result)) {
			echo "
			<div class='col mb-4'>
                <div class='card h-100'>
                    <img src=".$row['image']." class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h4 class='card-title text-danger name'>". $row['name']."</h4>
                        <p class='card-text desc'>". $row['description']."</p>
                        <h5 class='card-text'><i class='fa fa-calendar-o text-danger' aria-hidden='true'></i>". $row['name']."</h5>
                    </div>  
                    <div class='card-footer text-center p-1'>
                        <a class='text-info font-weight-bold mr-4' href='update.php?id=".$row['animal_id']."'>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> Event details</a>
                        <a class='text-warning font-weight-bold mx-auto' href='update.php?id=".$row['animal_id']."'>Edit <i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
                    </div>
                </div>
            </div>
			";
		}


		// Free result set
		mysqli_free_result($result);
		// Close connection
		mysqli_close($conn);
	?>
	
	</div>

	<footer class="wrapper-footer">
      <div class="footer-header">
        <!-- Just a Color -->
      </div>
      <div class="footer-body">
        <div class="footer-body-up">
          <div class="footer-body-row">
            <h5 class="footer-title">social media</h5>
            <hr class="footer-title-underline">
            <div class="footer-body-links">
              <p class="footer-text fire">
                <a class="footer-link" target="_blank" href="https://www.facebook.com/LaGomba-103065104591559">Facebook</a>
              </p>
            </div>
          </div>
          <div class="footer-body-row">
            <h5 class="footer-title">products</h5>
            <hr class="footer-title-underline">
            <div class="footer-body-links">
              <p class="footer-text mushroom">
                <a class="footer-link" href="index.php">Mushrooms</a>
              </p>
              <p class="footer-text bulb">
                <a class="footer-link" href="aboutme.php">About me</a>
              </p>
              <p class="footer-text scroll">
                <a class="footer-link" href="recipes.php">Recipes</a>
              </p>
            </div>
          </div>
          <div class="footer-body-row">
            <h5 class="footer-title">contact</h5>
            <hr class="footer-title-underline">
            <div class="footer-body-links">
              <p class="footer-text">
                Markhofgasse 19
              </p>
              <p class="footer-text">
                Wien | 1030
              </p>

              <p class="footer-text">
                <a class="footer-link" href="mailto:rr.noar@gmail.com">rr.noar@gmail.com</a>
              </p>
              <p class="footer-text"></p>
            </div>
          </div>
        </div>
        <div class="footer-body-down">
          <div class="footer-body-row">
            <h5 class="footer-title">lagomba</h5>
            <hr class="footer-title-underline">
            <div class="footer-body-links">
              <iframe class="footer-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2659.6938790047197!2d16.406720115529684!3d48.19324935526099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476d075b1edff245%3A0xaef7a8ddf96bc82d!2sMarkhofgasse%2019%2C%201030%20Wien!5e0!3m2!1sde!2sat!4v1593439331736!5m2!1sde!2sat" frameborder="0" style="border: 0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="copyright-container">
          <p class="copyright-container-text footer-text">
            © 2020 Copyright
            <a class="copyright-container-link footer-link" href="index.html">
              LaGomba
            </a>
          </p>
        </div>
      </div>
    </footer>
	
</body>
</html>
<?php ob_end_flush(); ?>