<?php
    ob_start();
    session_start();
    require_once 'db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        header("Location: ../login.php");
        exit;
    } 

    if( isset($_SESSION['admin']) ) {
      // select logged-in users details
      $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
      $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    }
  
?>
<!DOCTYPE html>
<html>
<?php include '../head.php'; ?>
<link rel="stylesheet" href="../css/styles.css">

<body class="main">
    <!-- Main Navbar -->
    <?php include '../nav_admin.php';?>
  	
    <div class="container mt-4 mx-auto text-center">
		<?php
			// Escape user inputs for security
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$time = mysqli_real_escape_string($conn, $_POST['time']);
			$description = mysqli_real_escape_string($conn, $_POST['description']);
			$image = mysqli_real_escape_string($conn, $_POST['image']);
			$difficulty = mysqli_real_escape_string($conn, $_POST['difficulty']);
            $dish = mysqli_real_escape_string($conn, $_POST['dish']);
      

			// attempt insert query execution
			$sql = "INSERT INTO recipes (name, time, description, difficulty, image, dish) VALUES ('$name', '$time', '$description', '$difficulty', '$image', '$dish')";
      

			if (mysqli_query($conn, $sql)) {
            $last_id_recipe = $conn->insert_id;
            foreach($_POST['recipes_description'] as $field) {
                if($field !== ''){
                $sql = "INSERT INTO recipe_steps (recipe_id, description) VALUES ('$last_id_recipe', '$field')";
                    if (!mysqli_query($conn, $sql)) {
                        die('Invalid query: ' . mysql_error());
                    }
                }
            }

            for($i = 0 ; $i < count($_POST['ing_amount']); $i++) {
                if($_POST['ing_amount'][$i] !== '' && $_POST['ing_unit'][$i] !== '' && $_POST['ing_description'][$i] !== '') {
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
			    //header("Refresh: 2; url= ../recipes.php");
			} else {
			    echo "<h1 class='text-red'>Something went wrong, please try again: </h1>" .
			         "<p>"  . $sql . "</p>" .
			         mysqli_error($conn);
			}
			mysqli_close($conn);		
		?>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>