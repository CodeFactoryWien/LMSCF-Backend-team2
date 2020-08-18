<?php 
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
    // Include and initialize database class 
    require_once 'actions/db_connect.php';
     
    // Get payment details 
    $paymentSql = "SELECT payments.*, userName, phone, address from users 
                    inner join payments 
                    on users.user_id = payments.user_id";
    $paymentData = mysqli_query($conn, $paymentSql);
     
    
}else{ 
    header("Location: /"); 
} 
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<link rel="stylesheet" href="css/styles.css">

<body >
   <a class="btn btn-warning m-4" href="index.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
    <div class="status container m-4 p-4">
        <?php if(!empty($paymentData)){ 
    		  foreach ($paymentData as $data) {
    	?>
            <h4>Payment Information</h4>
            <p><b>TXN ID:</b> <?php echo $paymentData['txn_id']; ?></p>
            <p><b>Paid Amount:</b> <?php echo $paymentData['payment_gross'].' '.$paymentData['currency_code']; ?></p>
            <p><b>Payment Status:</b> <?php echo $paymentData['payment_status']; ?></p>
            <hr>
        <?php }}else{ ?>
            <h1 class="error">No orders yet!</h1>
        <?php } ?>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>