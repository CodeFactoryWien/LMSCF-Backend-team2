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
         $date_from = mysqli_real_escape_string($conn, $_POST['date_from']);
         $date_to = mysqli_real_escape_string($conn, $_POST['date_to']);
			
			// attempt insert query execution
			$sql = "INSERT INTO harvest 
			(name, date_from, date_to) 
			VALUES 
			('$name', '$date_from','$date_from')";
			
			if (mysqli_query($conn, $sql)) {
			    echo "<h1 class='text-dark'>New harvest created.<h1>";
			    header("Refresh: 2; url= ../products.php");
			} else {
			    echo "<h1 class='text-red'>Something went wrong, please try again! </h1>" .
			         "<p>"  . $sql . "</p>" .
			         mysqli_error($conn);
			}
			mysqli_close($conn);		
		?>
    </div>

</body>
</html>
<?php ob_end_flush(); ?>

