<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    if (isset($_SESSION['admin']) && isset($_SESSION['user'])) {
        // select logged-in users details
        $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    }

    if ($_GET['id']) {
        $id = $_GET['id'];
    
        $sql = "SELECT * FROM products WHERE product_id = {$id}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        

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
            
            <img src="img/<?php echo $row['image']?>" alt="<?=$row['name']?>" class="img-fluid col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5" >
           

            <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 py-3 pl-3 pr-5">
                <?php echo "
                <h2><b> ". $row['name']."</b></h2>
                    <h4><b>".$row['quality']."</b></h4>
                    <p class='pr-4'>".$row['description']."</p>
                    <p><b>What is ".$row['quality']."?</b><br>
                    ".$row['qualityDescription']."</p>
                    <p><b>Next Harvest: </b> ".$row['date_from']."<br>
                    <b>Requires delivery by </b> ".$row['date_to']."</p>

                    <p><b>Get ".$row['amount']." for €".$row['price'].".-</b></p>
                    
                ";?>

                <form action="index.php?page=cart" method="post">
                    <input type="number" name="quantity" value="1" min="1" max="<?=$row['quantityAvailable']?>" placeholder="Quantity" required>
                    <input type="hidden" name="product_id" value="<?=$row['id']?>">
                    <input type="submit" value="Add To Cart" class="btn btn-warning">
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
    </div>
    <!-- Main Content -->


    <!-- Footer -->
    <?php include 'footer.php'; ?>
    
    <?php
        }
    ?>

</body></html>
    
<?php ob_end_flush(); ?>