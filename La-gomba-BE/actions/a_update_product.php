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
				$id = $_POST['product_id'];
				$name = mysqli_real_escape_string($conn, $_POST['name']);
                $quality = mysqli_real_escape_string($conn, $_POST['quality']);
                $price = mysqli_real_escape_string($conn, $_POST['price']);
                $date_from = mysqli_real_escape_string($conn, $_POST['date_from']);
                $amount = mysqli_real_escape_string($conn, $_POST['amount']);
                $unit = mysqli_real_escape_string($conn, $_POST['unit']);
                $image = mysqli_real_escape_string($conn, $_POST['image']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                

		        $sql = "UPDATE products SET name = '$name', quality = '$quality', price = '$price', date_from = '$date_from' , amount = '$amount' , unit = '$unit', image = '$image', description = '$description'  
		    		WHERE product_id = {$id}"; 

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