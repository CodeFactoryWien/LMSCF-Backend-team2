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
        $currentQty = $_SESSION['products'][$_POST['product_id']]['qty']+1;
        $_SESSION['products'][$_POST['product_id']]=array('qty'=>$currentQty,'name'=>$product['name'],'image'=>$product['image'],'price'=>$product['price'], 'amount'=>$product['amount']);
        $product='';
        //header("Location:card/list.php");
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
        //header("Location:shopping-cart.php");   
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
    <div class="paypal">
        
            
         
    </div>

    <!-- Main Content -->
    <div class="container mx-auto font-weight-bold mt-2 py-3">
        <?php if(!empty($_SESSION['products'])) { ?>
        <nav class="navbar navbar-inverse" style="background:#04B745;">
		    <div class="container-fluid pull-left" style="width:300px;">
		      <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Shopping Cart</a> </div>
		    </div>
		    <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="list.php?action=emptyall" class="btn btn-info">Empty cart</a></div>
        </nav>
        <table class="table table-striped">
		    <thead>
		      <tr>
		        <th>Image</th>
		        <th>Name</th>
		        <th>Price</th>
		        <th>Qty</th>
                <th>Actions</th>
		      </tr>
		    </thead>
            
		    <?php foreach($_SESSION['products'] as $key=>$product):?>
                <input type="hidden" value="<?php print $key?>" name="ids[]">
            
    		    <tr>
    		      <td><img src="<?php print $product['image']?>" width="50"></td>
    		      <td><?php print $product['name']?></td>
    		      <td>$<?php print $product['price']?></td>
    		      <td><?php print $product['qty']?></td>
                  <td><a href="list.php?action=empty&product_id=<?php print $key?>" class="btn btn-info">Delete</a></td>
    		    </tr>
    		    <?php $total = $total+($product['price']*$product['qty']);?>
    		    <?php endforeach;?>

    		    <tr><td colspan="5" align="right"><h4>Total:$<?php print $total?></h4></td></tr>
        </table>
		  
        <div id="paypal-button"></div>
        
    <?php } else { echo '<p class="text-center">The card is empty!</p>'; } ?>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</body>
</html>

<?php ob_end_flush(); ?>

<script>
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
                        currency: '<?php echo 'USD'; ?>'
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
                $.get('actions/process.php', { paymentID: data.paymentID,token: data.paymentToken, payerID: data.payerID, pid: pid}, function(response) {
                    if (response) {
                        alert("Thank you for your purchase!")
                        setTimeout("window.location='list.php'", 1000);
                    }
                });
            });
        }
    }, '#paypal-button');
}
</script>