<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    if( isset($_SESSION['admin']) && isset($_SESSION['user']) ) {
        // select logged-in users details
        $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    }
  
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
    <div  class="container-fluid row row-cols-1 row-cols-md-2 row-cols-lg-3 mx-auto my-4">
        <?php
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);
            // fetch the next row (as long as there are any) into $row
            while($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class='col mb-4'>
                    <div class='card h-100'>
                        <img src=img/".$row['image']." class='card-img-top' alt='". $row['name']."'>
                        <div class='card-body'>
                            <h4 class='card-title text-danger name'>". $row['name']."</h4>
                            <h5>". $row['quality']."<h5>
                            <h5>". $row['amount']." for € ". $row['price'].".-<h5>
                            <h5 class='card-text'>Available from: <i class='fa fa-calendar-o text-danger' aria-hidden='true'></i>". $row['date_from']."</h5>
                        </div>  
                        <div class='card-footer text-center p-1'>
                            <a class='text-info font-weight-bold mr-4' href='update.php?id=".$row['product_id']."'></a>
                            <a href='product_detail.php?id=".$row['product_id']."'><i class='fa fa-info-circle' aria-hidden='true'></i> Product details</a>
                        </div>
                    </div>
                </div>
                ";
            }


            // Free result set
            mysqli_free_result($result);
            // Close connection
            mysqli_close($conn);
        ?>
    </div>
    <!-- Main Content -->


    <!-- Footer -->
    <?php include 'footer.php'; ?>


</body></html>

<?php ob_end_flush(); ?>