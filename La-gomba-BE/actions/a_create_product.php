<?php
  ob_start();
  session_start();
  require_once 'db_connect.php';

  if( isset($_SESSION['admin']) ) {
    // select logged-in users details
    $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
  }
  
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LaGomba</title>

  <!-- font -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&amp;display=swap" rel="stylesheet">

  <!-- favicon -->
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

  <!-- CSS -->
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

  <!-- JavaScript -->
  <script defer="" src="../js/stickyNav.js"></script>
</head>
<body class="main">

    <!-- Main Navbar -->
    <nav id="navbar" class="wrapper-nav">
        <div class="nav-links">
            <div class="nav-left">
                <a href="index.php" class="wrapper-logo">
                  <img class="logo-nav" src="img/logo-body.png" alt="">
                  <img class="logo-nav" src="img/logo-arrow.png" alt="">
                </a>
            </div>
            <div class="nav-right">
                <a class="nav-link" href="../product.php">
                  <p><b>products</b></p>
                </a>
                <a class="nav-link" href="../create_product.php">
                  <p><b>new products</b></p>
                </a>
                <a class="nav-link" href="../recipes.php">
                  <p><b>recipes</b></p>
                </a>
                <a class="nav-link" href="../create_recipe.php">
                  <p><b>new recepie</b></p>
                </a>
                <?php
                if(!isset($_SESSION['admin'])) {
                    echo '<div class="nav-link-contact">
                          <p><a href="login.php"><b>login</b></a></p>
                        </div>';
                } else {
                  echo '<a class="nav-link" href="logout.php?logout" >
                          <p><b>log out</b></p>
                        </a>';
                }
                ?>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mx-auto text-center">
		<?php
			// Escape user inputs for security
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$image = mysqli_real_escape_string($conn, $_POST['image']);
			$quality = mysqli_real_escape_string($conn, $_POST['quality']);
			$description = mysqli_real_escape_string($conn, $_POST['description']);
			$price = mysqli_real_escape_string($conn, $_POST['price']);
			$date_from = mysqli_real_escape_string($conn, $_POST['date_from']);
			$amount = mysqli_real_escape_string($conn, $_POST['amount']);
      $unit = mysqli_real_escape_string($conn, $_POST['unit']);

			// attempt insert query execution
			$sql = "INSERT INTO products 
			(name, image, quality, price, description, date_from, amount, unit) 
			VALUES 
			('$name', '$image', '$quality', '$price', '$description', '$date_from', '$amount', '$unit')";
			
			if (mysqli_query($conn, $sql)) {
			    echo "<h1 class='text-dark'>New product created.<h1>";
			    header("Refresh: 3; url= ../admin.php");
			} else {
			    echo "<h1 class='text-red'>Something went wrong, please try again: </h1>" .
			         "<p>"  . $sql . "</p>" .
			         mysqli_error($conn);
			}
			mysqli_close($conn);		
		?>
    </div>
    <!-- Footer -->
    <?php include '../footer.php'; ?>
</body>
</html>
<?php ob_end_flush(); ?>