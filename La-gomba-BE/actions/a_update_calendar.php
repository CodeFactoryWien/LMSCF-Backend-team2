<?php
    ob_start();
    session_start();
    require_once 'db_connect.php'; 

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        header("Location: ../login.php");
        exit;
    }

    // select logged-in admins details
    $sql = "SELECT * FROM users WHERE user_id=".$_SESSION['admin'];
    $result = mysqli_query($conn, $sql);
    $userRow = mysqli_fetch_assoc($result);    
?>
<!DOCTYPE html>
<html>
<?php include '../head.php'; ?>
<link rel="stylesheet" href="../css/styles.css">

<body>
    <!-- Main Navbar -->
    <?php include '../nav_admin.php'; ?>

	<div class="container mt-4 mx-auto text-center h-100">
		<?php		
			if ($_POST) {
				$id = $_POST['harvest_id'];
				$name = mysqli_real_escape_string($conn, $_POST['name']);
        $date_from = mysqli_real_escape_string($conn, $_POST['date_from']);
        $date_to = mysqli_real_escape_string($conn, $_POST['date_to']);
                
          $sql = "UPDATE harvest SET name = '$name', date_from = '$date_from' , date_to = '$date_to'   
		    		WHERE harvest_id = {$id}"; 

		        if(mysqli_multi_query($conn, $sql) === TRUE) {
		           echo  "<h1 class='text-dark'>Successfully Updated</h1>";
		           header("Refresh: 2; url= ../products.php");
		        } else {
		            echo "Error while updating : ". mysqli_error($conn);
		        }
		        mysqli_close($conn);
		    }
		?>
 	</div>
 	
</body>
</html>
<?php ob_end_flush(); ?>

