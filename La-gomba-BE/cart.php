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
        $_SESSION['products'][$_POST['product_id']]=array('qty'=>$currentQty,'name'=>$product['name'],'image'=>$product['image'],'price'=>$product['price'], 'amount'=>$product['amount']);
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
		        <th>Price</th>
		        <th>Qty</th>
                <th>Actions</th>
		      </tr>
		    </thead>
            
		    <?php foreach($_SESSION['products'] as $key=>$product):?>
                <input type="hidden" value="<?php print $key;?>" name="ids[]">
                <input type="hidden" value="<?php print $product['qty'];?>" name="amounts[]">
            
    		    <tr>
    		      <td><img src="<?php print $product['image']?>" width="50"></td>
    		      <td><?php print $product['name']?></td>
    		      <td>$<?php print $product['price']?></td>
    		      <td><?php print $product['qty']?></td>
                  <td><a href="cart.php?action=empty&product_id=<?php print $key?>" class="btn btn-danger">Delete</a></td>
    		    </tr>
    		    <?php $total = $total+($product['price']*$product['qty']);?>
    		    <?php endforeach;?>

    		    <tr><td colspan="5" align="right"><h4>Total:$<?php print $total?></h4></td></tr>
        </table>
		  
        <div id="paypal-button"></div>
        
    <?php } else { echo '<h1 class="text-center"><b>The card is empty!<b></h1>'; } ?>
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
                console.log(pid +'ok')
                let amounts = $("input[name='amounts[]']").map(function(){return $(this).val();}).get();
                let pamounts = amounts.join(',')
                console.log(pamounts +'ok')
                $.get('actions/process.php', { paymentID: data.paymentID,token: data.paymentToken, payerID: data.payerID, pid: pid, pamounts: pamounts}, function(response) {
                    if (response) {
                        console.log('res', response)
                        Swal.fire(
                          'Thank you!',
                          'Thank you for your purchase!',
                          'success'
                        )
                        setTimeout("window.location='cart.php'", 3000);
                    }
                });
            });
        }
    }, '#paypal-button');
}
</script>