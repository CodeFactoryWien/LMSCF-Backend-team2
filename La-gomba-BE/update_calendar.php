<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        header("Location: login.php");
        exit;
    } 

    if( isset($_SESSION['admin']) ) {
      // select logged-in users details
      $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
      $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    }

     if ($_GET['id']) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM harvest WHERE harvest_id = {$id}" ;
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);
       
        mysqli_close($conn);
  
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
    <div class="container mx-auto bg-dark font-weight-bold mt-2 py-3">
        <form action="actions/a_update_calendar.php" method ="post" >
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4 mb-2">
                    <label for="name">Name: </label>
                    <input type="text" class="form-control" name="name" placeholder="Mushroom Name" value="<?php echo $data['name'] ?>">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="date_from">Available from: </label>
                    <input type="date" class="form-control" name="date_from" value="<?php echo $data['date_from'] ?>">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="date_from">Available until: </label>
                    <input type="date" class="form-control" name="date_to" value="<?php echo $data['date_to'] ?>">
                </div>
            </div>
            
            <div class="form-group col-md-4 mx-auto">
                <input type= "hidden" name="harvest_id" value="<?php echo $data['harvest_id'] ?>" />
                <input type="submit" class="btn btn-dark form-control" value="Update Date">
            </div>

        </form>
    </div>

    
    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>

<?php
}
?>
<?php ob_end_flush(); ?>


