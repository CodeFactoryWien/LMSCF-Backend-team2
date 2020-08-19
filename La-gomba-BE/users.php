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
    <div class="container  row mx-auto my-4">
        <table class='table table-striped border border-warning'>
            <thead class="bg-warning">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                </tr>
            </thead>
        <?php
            $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                    // fetch the next row (as long as there are any) into $row
                    while($row = mysqli_fetch_assoc($result)) {
                    echo "
                        <tr>
                          <td>". $row['userName']."</td>
                          <td>". $row['userEmail']."</td>
                          <td>". $row['address']."</td>
                          <td>". $row['phone']."</td>
                        </tr>
                    ";

            }


            // Free result set
            mysqli_free_result($result);
            // Close connection
            mysqli_close($conn);
               
        ?>
        </table>
    </div>
    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>

<?php ob_end_flush(); ?>
