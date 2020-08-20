<?php
    ob_start();
    session_start();
    require_once 'db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        header("Location: ../login.php");
        exit;
    } 

    if( isset($_SESSION['admin']) ) {
      // select logged-in users details
      $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
      $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    }
  
?>
<!DOCTYPE html>
<html>
<?php include '../head.php'; ?>
<link rel="stylesheet" href="../css/styles.css">

<body class="main">
    <!-- Main Navbar -->
    <?php include '../nav_admin.php';?>

    <div class="container mt-4 mx-auto text-center">
        <?php 
            if ($_POST) {
                $id = $_POST['id'];

                $sql = "DELETE FROM recipe_steps WHERE recipe_id = {$id};";
                $sql .= "DELETE FROM recipe_ingredients WHERE recipe_id = {$id};";
                $sql .= "DELETE FROM recipes WHERE recipe_id = {$id}";

                if($conn->multi_query($sql) === TRUE) {
                    echo "<h1 class='text-dark'>Successfully deleted!</h1>" ;
                    header("Refresh: 2; url= ../recipes.php");
                } else {
                echo "Error updating record : " . $conn->error;
                }

                $conn->close();
            }
        ?>
    </div>
    
</body>
</html>
<?php ob_end_flush(); ?>