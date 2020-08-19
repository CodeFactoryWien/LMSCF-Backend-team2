<?php 
ob_start();
session_start();
if (isset($_SESSION['admin'])) {
    // Include and initialize database class 
    require_once 'actions/db_connect.php';

    $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC); 

    // Get payment details 
    $paymentSql = "SELECT payments.*, userName, phone, address, name  from users 
                    inner join payments on users.user_id = payments.user_id
                    inner join products on products.product_id = payments.product_id
                    ";
    $paymentData = mysqli_query($conn, $paymentSql);
     
    
}else{ 
    header("Location: /"); 
} 
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body class="main">
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Main Navbar -->
    <?php
        include 'nav_admin.php';
    ?>
    <div class="container mx-auto mt-2 py-3">
<?php if(!empty($paymentData)){ 
        foreach ($paymentData as $data) {
            if($data['txn_id']) { ?>
                <h4><b>Payment from Paypal</b></h4>
                <p><b>TXN ID:</b> <?php echo $data['txn_id']; ?></p>
                <p><b>Customer Name:</b> <?php echo $data['payer_name']; ?></p>
                <p><b>Customer Email:</b> <?php echo $data['payer_email']; ?></p>
                <p><b>Paid Amount:</b> <?php echo $data['payment_gross'].' '.$data['currency_code']; ?></p>
                <p><b>Payment Status:</b> <?php echo $data['payment_status']; ?></p>
                <p><b>Product: </b> <?php echo $data['name']; ?></p>
                <p><b>Qty: </b> <?php echo $data['amount']; ?></p>
                <p><b>Payment Date:</b> <?php echo $data['created']; ?></p>
                <hr>
  <?php     } else { ?>
                <h4><b>Payment on Delivery</b></h4>
                <p><b>Customer Name:</b> <?php echo $data['userName']; ?></p>
                <p><b>Customer Address:</b> <?php echo $data['address']; ?></p>
                <p><b>Customer Phone:</b> <?php echo $data['phone']; ?></p>
                <p><b>Product: </b> <?php echo $data['name']; ?></p>
                <p><b>Qty: </b> <?php echo $data['amount']; ?></p>
                <p><b>Payment Date:</b> <?php echo $data['created']; ?></p>
                <hr>
  <?php     }
        }
     } else { ?>
            <h1 class="error">No orders yet!</h1>
        <?php } ?>
    </div>
    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
<?php ob_end_flush(); ?>