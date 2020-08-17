<?php 
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
    // Include and initialize database class 
    include_once 'DB.php'; 
    $db = new DB; 
     
    // Get payment details 
    $conditions = ''; 
    $paymentDatas = $db->getRows('payments'); 
     
    
}else{ 
    header("Location: ../"); 
} 
?>
<!DOCTYPE html>
<html>
<?php include '../head.php'; ?>
<link rel="stylesheet" href="../css/styles.css">

<body class="main">

<div class="status">
    <?php if(!empty($paymentDatas)){ 
		  foreach ($paymentDatas as $paymentData) {
	?>
        <h1 class="success">Your Payment has been Successful!</h1>
        <h4>Payment Information</h4>
        <p><b>TXN ID:</b> <?php echo $paymentData['txn_id']; ?></p>
        <p><b>Paid Amount:</b> <?php echo $paymentData['payment_gross'].' '.$paymentData['currency_code']; ?></p>
        <p><b>Payment Status:</b> <?php echo $paymentData['payment_status']; ?></p>
        <p><b>Payment Date:</b> <?php echo $paymentData['created']; ?></p>
        <p><b>Payer Name:</b> <?php echo $paymentData['payer_name']; ?></p>
        <p><b>Payer Email:</b> <?php echo $paymentData['payer_email']; ?></p>
		<hr>
        <!--<h4>Product Information</h4>
        <p><b>Name:</b> <?php echo $productData['name']; ?></p>
        <p><b>Price:</b> <?php echo $productData['price'].' '.$productData['currency']; ?></p>
    	-->
    <?php }}else{ ?>
        <h1 class="error">Your Payment has Failed</h1>
    <?php } ?>
</div>
</body>
</html>
<?php ob_end_flush(); ?>