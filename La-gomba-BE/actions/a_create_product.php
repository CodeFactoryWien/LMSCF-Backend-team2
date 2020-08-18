<?php
    ob_start();
    session_start();
    require_once 'db_connect.php';
    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        //header("Location: ../login.php");
        echo 'error';
        exit;
    } 
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
	    echo "New product created.";
	} else {
	    echo "Something went wrong, please try again!";
	}
	mysqli_close($conn);		
?>

<?php ob_end_flush(); ?>