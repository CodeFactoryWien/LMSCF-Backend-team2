<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    if(isset($_SESSION['admin'])) {
        $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    } else if(isset($_SESSION['user'])) {
		$res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    }

    if ($_GET['id']) {
        $id = $_GET['id'];
    
        $sql = "SELECT * FROM products WHERE product_id = {$id}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $sqlSales = "SELECT IFNULL(sum(amount),0) as total FROM payments WHERE product_id = {$id}";
        $resultSales = $conn->query($sqlSales);
        $rowSales = $resultSales->fetch_assoc();
        //echo $rowSales['total'];
        
?>
<!DOCTYPE html>
<html>
    <?php include 'head.php'; ?>
    <script defer="" src="js/main.js"></script>
    
<body>
    <!-- Header-->
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
    <div  class="container-fluid mx-auto my-4 px-4">
	    <section>
	        <div class="row my-5">
	            <img src="<?php echo $row['image']?>" alt="<?=$row['name']?>" class="img-fluid col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5" >
	            <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 py-3 pl-3 pr-5">
	                <?php echo "
                    <h4 class='text-danger'>For now delivery is only possible in Vienna (Or pick-up at our cellar)</h4>
	                <h2><b> ". $row['name']."</b></h2>
	                    <h4><b>Quality ".$row['quality']."</b></h4>
	                    <p class='pr-4'>".$row['description']."</p>
	                    <p><b>What is ".$row['quality']."?</b><br>
	                    ".$row['qualityDescription']."</p>
	                    <p><b>Next Harvest: </b><i class='fa fa-calendar-check-o' aria-hidden='true'></i> ".$row['date_from']."<br>
	                    <b>Requires delivery by </b> ".$row['date_to']."</p>
						<b>Stock: ".($row['amount']-$rowSales['total']) ."<br>
	                    <p><b>Get 1 Kg for € ".$row['price'].".</b></p>  
	                ";?>
	  					<!-- list.php?action=addcart -->
	                <form action="" method="post">
	                    <input class="" type="number" name="quantity" id="quantity" value="1" min="1" max="<?=($row['amount']-$rowSales['total'])?>" placeholder="Quantity" required>
	                    <select class="custom-select w-25" id="inputGroupSelect01" name="unit">
	                        <option value="kg">Kg</option>
	                    </select>
	                    <input type="hidden" id="product_id" name="product_id" value="<?=$row['product_id']?>">
	                    <input id="addcart" type="submit" value="Add To Cart" class="new btn btn-warning">
	                </form>
	            </div>
	        </div>
	    </section>

	    
	        <?php
	            // Free result set
	            mysqli_free_result($result);
	            // Close connection
	            mysqli_close($conn);
	        ?>

	<a href="products.php" class="font-weight-bold text-dark back">
    <i class="fa fa-arrow-circle-o-left back" aria-hidden="true"></i>Back</a>
    </div>
	<!-- Main Content -->

	


    <!-- Footer -->
    <?php include 'footer.php'; ?>
    
    <?php
        }
    ?>

</body></html>
    
<?php ob_end_flush(); ?>

<script type="text/javascript">
	$(document).ready(function(){
      $("#addcart").click(function(e){
          e.preventDefault();
        	$.ajax({type: "POST",
                url: "cart.php?action=addcart",
                data: { product_id: $("#product_id").val(), quantity: $("#quantity").val() },
                success:function(result){
                	if(result) {
                		Swal.fire(
						  'Thank you!',
						  'The product was added to the shopping card!',
						  'success'
						)
                	}
        		}
        	});
      });
    });
</script>