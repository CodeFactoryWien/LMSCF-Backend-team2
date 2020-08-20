<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        header("Location: login.php");
        exit;
    } 

    if( isset($_SESSION['admin'])) {
        // select logged-in users details
        $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
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

    <!-- Main Content -->
    <div class="container mx-auto font-weight-bold mt-2 bg-dark text-white py-3 my-4">
        <form action="actions/a_create_calendar.php" method ="post" >
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4 mb-2">
                    <label for="name">Name: </label>
                    <input type="text" class="form-control" name="name" placeholder="Type of mushroom">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="date_from">Available from: </label>
                    <input type="date" class="form-control" name="date_from">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="date_from">Available to: </label>
                    <input type="date" class="form-control" name="date_to">
                </div>
            </div>
            
            <div class="form-group col-md-4 mx-auto">
                <input type="submit" class="btn btn-success form-control" value="Create Harvest">
            </div>
        </form>
    </div>
      
     
      <!-- Footer -->
    <?php include 'footer.php'; ?>

</body></html>

<?php ob_end_flush(); ?>
