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

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <div class="nav-left">
          <a class="wrapper-logo" href="index.php">
              <img class="logo-nav" src="img/logo-body.png" alt="">
              <img class="logo-nav" src="img/logo-arrow.png" alt="">
          </a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                  <a class="nav-link" href="index.php">HOME </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="recipes.php">RECIPES</a>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Products
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="create_product.php">Add new product</a>
                  </div>
              </li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Recipes
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="create_recipe.php">Add new recipe</a>
                  </div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="aboutme.php">ABOUT ME</a>
              </li>
          </ul>
          <?php
              if(!isset($_SESSION['admin'])) {
                  echo '<a href="login.php" class="nav-link  btn btn-outline-warning">login</a>';
              } else {
                  echo '<a href="logout.php?logout" class="nav-link  btn btn-outline-warning">logout</a>';  
              }
          ?>
      </div>
    </nav>
  	
    <div class="container mt-4 mx-auto text-center">
		<?php
			// Escape user inputs for security
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$time = mysqli_real_escape_string($conn, $_POST['time']);
			$description = mysqli_real_escape_string($conn, $_POST['description']);
			$image = mysqli_real_escape_string($conn, $_POST['image']);
			$difficulty = mysqli_real_escape_string($conn, $_POST['difficulty']);

			// attempt insert query execution
			$sql = "INSERT INTO recipes (name, time, description, difficulty, image) VALUES ('$name', '$time', '$description', '$difficulty', '$image')";
      

			if (mysqli_query($conn, $sql)) {
          $last_id_recipe = $conn->insert_id;
          foreach($_POST['recipes_description'] as $field)
          {
              if($field !== '')
              {
                $sql = "INSERT INTO recipe_steps (recipe_id, description) VALUES ('$last_id_recipe', '$field')";
                  if (!mysqli_query($conn, $sql)) {
                    die('Invalid query: ' . mysql_error());
                  }
              }
          }

          for($i = 0 ; $i < count($_POST['ing_amount']); $i++)
          {
              if($_POST['ing_amount'][$i] !== '' && $_POST['ing_unit'][$i] !== '' && $_POST['ing_description'][$i] !== '')
              {
                $amount = $_POST['ing_amount'][$i];
                $unit = $_POST['ing_unit'][$i];
                $description = $_POST['ing_description'][$i];
                $sql = "INSERT INTO recipe_ingredients (recipe_id, amount, unit, description) VALUES ('$last_id_recipe', '$amount', '$unit', '$description')";
                  if (!mysqli_query($conn, $sql)) {
                    die('Invalid query: ' . mysql_error());
                  }
              }
          }
			    echo "<h1 class='text-white'>New recipe created.<h1>";
			    header("Refresh: 3; url= ../admin.php");
			} else {
			    echo "<h1 class='text-red'>Something went wrong, please try again: </h1>" .
			         "<p>"  . $sql . "</p>" .
			         mysqli_error($conn);
			}
			mysqli_close($conn);		
		?>
    </div>
    <div class="card-footer text-dark bg-transparent text-center font-weight-bold"> &copy; 2020 </div>
</body>
</html>
<?php ob_end_flush(); ?>