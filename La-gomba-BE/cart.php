<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';
    //var_dump(!isset($_SESSION['user']), !isset($_SESSION['admin']));
    // if session is not set this will redirect to login page
    if( !isset($_SESSION['user']) && !isset($_SESSION['admin']) ) {
        header("Location: login.php");
        exit;
    } 

    if(isset($_SESSION['admin'])) {
        $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    } else if(isset($_SESSION['user'])) {
		$res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    }

    $action = isset($_GET['action'])?$_GET['action']:"";

	if($_POST['product_id'] && $action=='addcart') { 
        //Finding the product by id
        $query = "SELECT * FROM products WHERE product_id={$_POST['product_id']}";
        $getProduct = mysqli_query($conn, $query);
        $product = mysqli_fetch_array($getProduct, MYSQLI_ASSOC);
        $currentQty = $_SESSION['products'][$_POST['product_id']]['qty']+$_POST['quantity'];
        $_SESSION['products'][$_POST['product_id']]=array('qty'=>$currentQty,'name'=>$product['name'],'image'=>$product['image'],'price'=>$product['price'], 'amount'=>$product['amount'], 'quality'=>$product['quality'], 'unit'=>$product['unit']);
        $product='';
        echo 'success';
        exit;
    }

    //Empty All
    if($action=='emptyall') {
        $_SESSION['products']=array();
        //header("Location:shopping-cart.php");   
    }

    //Empty one by one
    if($action=='empty') {
        $product_id = $_GET['product_id'];
        $products = $_SESSION['products'];
        unset($products[$product_id]);
        $_SESSION['products']= $products;   
    }

    include_once 'actions/Paypal.php';
    $paypal = new PaypalExpress;

    
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body class="main">
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Main Navbar -->
    <?php
        if(!isset($_SESSION['admin'])) {
            include 'nav_user.php';
        } else {
            include 'nav_admin.php';
        }
    ?>

    <!-- Main Content -->
    <div class="container mx-auto font-weight-bold mt-2 py-3">
        <?php if(!empty($_SESSION['products'])) { ?>
        <nav class="navbar navbar-inverse bg-warning" style="background:#04B745;">
		    <div class="container-fluid pull-left" style="width:300px;">
		      <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Shopping Cart</a> </div>
		    </div>
		    <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="cart.php?action=emptyall" class="btn btn-dark">Empty cart</a></div>
        </nav>
        <table class="table table-striped bg-white">
		    <thead>
		      <tr>
		        <th>Image</th>
		        <th>Name</th>
		        <th>Quality</th>
                <th>Price</th>
		        <th>Qty</th>
                <th>Unit</th>
                <th>Actions</th>
		      </tr>
		    </thead>
            
		    <?php foreach($_SESSION['products'] as $key=>$product):?>
                <input type="hidden" value="<?php print $key;?>" name="ids[]">
                <input type="hidden" value="<?php print $product['qty'];?>" name="amounts[]">
    		    <tr>
    		      <td><img src="<?php print $product['image']?>" width="50"></td>
    		      <td><?php print $product['name']?></td>
                  <td><?php print $product['quality']?>‎</td>
    		      <td>€<?php print $product['price']?>‎</td>
    		      <td><?php print $product['qty']?></td>
                  <td><?php print $product['unit']?></td>
                  <td><a href="cart.php?action=empty&product_id=<?php print $key?>" class="btn btn-danger">Delete</a></td>
    		    </tr>
    		    <?php $total = $total+($product['price']*$product['qty']);?>
    		    <?php endforeach;?>

    		    <tr><td colspan="t" align="right"><h4>Total:€<?php print $total?>‎</h4></td></tr>
        </table>
        <div class="row">
            <div class="col-sm-12 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <div id="paypal" class="tab-pane pt-3">
                            <h5 class="pb-2">Select your payment method</h5>
                            
                            <div class="form-group"> 
                                <label class="radio-inline"> <input type="radio" name="payment" checked
                                value="paypal-button"> Paypal 
                                </label>
                                <label class="radio-inline"> <input type="radio" name="payment" class="ml-5"
                                value="on-delivery" > On Delivery 
                                </label>
                            </div>
                            <div id="paypal-button" class="show-hide-element"></div>
                            <input type="button" name="cash" id="on-delivery" class="btn btn-warning text-primary font-weight-bold rounded-pill show-hide-element" value="Buy products" style="display: none;">
                            <p class="text-muted"> Note: After clicking the payment option, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website. 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <?php } else { echo '<h1 class="text-center"><b>The cart is empty!<b></h1>'; } ?>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</body>
</html>

<?php ob_end_flush(); ?>

<script>
$(document).ready(function(){
const elementExists = !!document.getElementById('paypal-button');
if (elementExists) {
    paypal.Button.render({
        // Configure environment
        env: '<?php echo $paypal->paypalEnv; ?>',
        client: {
            sandbox: '<?php echo $paypal->paypalClientID; ?>',
            production: '<?php echo $paypal->paypalClientID; ?>'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },
        // Set up a payment
        payment: function (data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: '<?php echo $total; ?>',
                        currency: '<?php echo 'EUR'; ?>'
                    }
                }]
          });
        },
        // Execute the payment
        onAuthorize: function (data, actions) {
            return actions.payment.execute()
            .then(function () {
                let products = $("input[name='ids[]']").map(function(){return $(this).val();}).get();
                let pid = products.join(',')
                let amounts = $("input[name='amounts[]']").map(function(){return $(this).val();}).get();
                let pamounts = amounts.join(',');
                let uid =  '<?php echo $userRow['user_id']; ?>';
                $.get('actions/process.php', { paymentID: data.paymentID,token: data.paymentToken, payerID: data.payerID, pid: pid, pamounts: pamounts, uid: uid}, function(response) {
                    if (response) {
                        Swal.fire(
                          'Thank you!',
                          'Thank you for your purchase!',
                          'success'
                        )
                        setTimeout("window.location='products.php'", 2000);
                    }
                });
            });
        }
    }, '#paypal-button');
}

// Payment options
$("input[name$='payment']").click(function() {
    $(".show-hide-element").hide();
    var val = $(this).val();
    $("#" + val).show();
});


$("#on-delivery").click(function() {
    let products = $("input[name='ids[]']").map(function(){return $(this).val();}).get();
    let pid = products.join(',')
    let amounts = $("input[name='amounts[]']").map(function(){return $(this).val();}).get();
    let pamounts = amounts.join(',');
    let uid =  '<?php echo $userRow['user_id']; ?>';
    let method = 'cash';
    $.get('actions/process.php', { pid: pid, pamounts: pamounts, uid: uid, method: method}, function(response) {
        if (response) {
            Swal.fire(
              'Thank you!',
              'Thank you for your purchase!',
              'success'
            )
            setTimeout("window.location='products.php'", 2000);
        }
    });
});



});
</script>