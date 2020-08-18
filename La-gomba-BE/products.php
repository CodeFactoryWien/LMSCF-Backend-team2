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
    <div class="container-fluid row mx-auto">
        <div  class="container-fluid col-9 row row-cols-1 row-cols-md-2 row-cols-lg-2 mx-auto my-4">
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
                                <h3 class='card-title text-warning'>". $row['name']."</h3>
                                <h5 class='card-text'>Quality " . $row['quality']."</h5>
                                <h5 class='card-text'>Price ". $row['price']."<i class='fa fa-eur' aria-hidden='true'></i> for 1Kg</h5>
                                
                            </div>  
                            <div class='card-footer link text-center p-1'>
                            <a class='text-info font-weight-bold mr-3' href='product_detail.php?id=".$row['product_id']."'>
                            <i class='fa fa-info-circle' aria-hidden='true'></i> View Product</a>";
                                if(isset($_SESSION['admin'])) {
                                    echo '
                                    <a href="update_product.php?id='.$row['product_id'].'" class="font-weight-bold text-warning mr-3">
                                    <i class="fa fa-pencil-square" aria-hidden="true"></i>Update</a>
                                    <a href="delete_product.php?id='.$row['product_id'].'" class="font-weight-bold text-danger ">
                                    <i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                    ';
                                } 
                                echo '          
                            </div>
                        </div>
                    </div>
                    ';
                }


                // Free result set
                mysqli_free_result($result);
               
            ?>
        </div>

        <div class="harvest container-fluid col-3 my-4 p-3 bg-secondary">
            <div class="d-flex flex-column">
                    <h3 class="text-warning">Upcoming harvests:</h3>
                    
                    <?php
                    $sql = "SELECT * FROM harvest";
                    $resuHa = mysqli_query($conn, $sql);
                        // fetch the next row (as long as there are any) into $row
                        while($data = mysqli_fetch_assoc($resuHa)) {
                            echo "
                            <div class='m-2' >
                                <h5 > ". $data['name']."</h5>
                                <div>
                                <span> from  ".$data['date_from']."</span>
                                <span> to  ". $data['date_to']."</span>
                                </div>
                                ";       
                                
                                    if(isset($_SESSION['admin'])) {
                                        echo '
                                        <a href="update_calendar.php?id='.$data['harvest_id'].'" class="font-weight-bold text-warning mr-3">
                                        <i class="fa fa-pencil-square" aria-hidden="true"></i>Update</a>
                                        <a href="delete_calendar.php?id='.$data['harvest_id'].'" class="font-weight-bold text-danger ">
                                        <i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                        <a href= "create_calendar.php"><button type="button" >Add a harvest date</button></a>
                                            ';
                                        } 
                                        echo '          
                            </div>';
                        }


                // Free result set
                mysqli_free_result($resuHa);
                // Close connection
                mysqli_close($conn);
            ?>
            </div>
        </div>


        </div>
    </div>
    <!-- Main Content -->

    <!-- Modal Contact -->
    <?php include 'contact.php'; ?>

    <!-- Footer -->
    <?php include 'footer.php'; ?>


</body></html>

<?php ob_end_flush(); ?>

<script src="js/main.js"></script>