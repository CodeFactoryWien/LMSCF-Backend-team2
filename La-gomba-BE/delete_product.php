<?php
 	ob_start();
  	session_start();
  	require_once 'actions/db_connect.php';

  	// if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        header("Location: login.php");
        exit;
    } 

  	if( isset($_SESSION['admin'])) {
    	// select logged-in users details
    	$res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
    	$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
  	}

  	if ($_GET['id']) {
		$id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body>
	<?php include 'nav_admin.php'; ?>
	<div class="container mt-4 mx-auto text-center">
		<h3 class="text-dark">Do you really want to delete this product?</h3>
		<form action ="actions/a_delete_product.php" method="post">
			<input type="hidden" name="id" value="<?php echo $id ?>" />
		    <button class="btn btn-danger" type="submit">Yes, delete it!</button >
		    <a href="products.php"><button class="btn btn-secondary" type="button">No, go back!</button></a>
		</form>
	</div>
	<?php include 'footer.php'; ?>

</body></html>

<?php
}
?>
<?php ob_end_flush(); ?>