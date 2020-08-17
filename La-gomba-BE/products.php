<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    if( isset($_SESSION['admin'])) {
        $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    } else if(isset($_SESSION['user'])) {
        $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    }
  
?>
<!DOCTYPE html>
<html>
    <?php include 'head.php'; ?>
    
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
    <div  class="container-fluid row row-cols-1 row-cols-md-2 row-cols-lg-3 mx-auto my-4">
        <?php
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);
            // fetch the next row (as long as there are any) into $row
            while($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class='col mb-4'>
                    <div class='card h-100'>
                        <img src=".$row['image']." class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h4 class='card-title text-danger name'>". $row['name']."</h4>
                            <p class='card-text desc'>". $row['description']."</p>
                            <h5 class='card-text'>Available from: <i class='fa fa-calendar-o text-danger' aria-hidden='true'></i>". $row['date_from']."</h5>
                        </div>  
                        <div class='card-footer link text-center p-1'>
                        <a class='text-info font-weight-bold mr-4' href='details.php?id=".$row['product_id']."'>
                        <i class='fa fa-info-circle' aria-hidden='true'></i> View Product</a>";
                            if(isset($_SESSION['admin'])) {
                                echo '
                                <a href="update_product.php?id='.$row['product_id'].'" class="font-weight-bold text-warning">Update</a>
                                <a href="delete_product.php?id='.$row['product_id'].'" class="font-weight-bold text-danger">Delete</a>
                                ';
                            } 
                             echo '
                             <form method="post" action="list.php?action=addcart">
                              <p style="text-align:center;color:#04B745;">
                                <button type="submit" class="btn btn-success">Add To Cart</button>
                                <input type="hidden" name="product_id" value="'.$row['product_id'].'">
                              </p>
                            </form>          
                        </div>
                    </div>
                </div>
                ';
            }


            // Free result set
            mysqli_free_result($result);
            // Close connection
            mysqli_close($conn);
        ?>
    </div>
    <!-- Main Content -->

    <!-- Modal Contact -->
    <?php include 'contact.php'; ?>

    <!-- Footer -->
    <?php include 'footer.php'; ?>


</body></html>

<?php ob_end_flush(); ?>

<script src="js/main.js"></script>