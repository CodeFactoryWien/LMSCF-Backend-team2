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

    <!-- Main Content -->
    <div class="container main mx-auto my-5 p-4">
        <h1 class="font-weight-bold mb-4">
            There´re so many Recipes
        </h1>
        <p class="py-3">
            Mushrooms are full of protein, fiber and many vitamins that makes
            them a perfect meat replacement and also can taste and feel like
            meat but has the benefits of a very low carbon footprint.
        </p>
    </div>          
    <div class="container mx-auto my-5">
        <div  class="container-fluid row row-cols-1 row-cols-md-1 row-cols-lg-1 mx-auto my-4">
            <?php
            $sql = "SELECT * FROM recipes";
            $result = mysqli_query($conn, $sql);

            //if (count(mysqli_fetch_assoc($result))===0)  {
            //    echo '<h1 class="text-center font-weight-bold">There are no Recipes</h1>';
            //}
            while($row = mysqli_fetch_assoc($result)) {

                $sqlstep = "SELECT * FROM recipe_steps where recipe_id=".$row['recipe_id'];
                $resultstep = mysqli_query($conn, $sqlstep);
                $sqlingr = "SELECT * FROM recipe_ingredients where recipe_id=".$row['recipe_id'];
                $resultingr = mysqli_query($conn, $sqlingr);
                echo '<div class="accordion reciCard mx-auto my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <img class="card-img" src="'
                                    .$row['image'].
                                '" alt="'
                                .$row['name'].
                            '">
                            </div>
                            <div class="col-sm-8 pt-5">
                                <h1 class="my-3 p-3">'
                                    .$row['name'].
                                '</h1>
                                <p class="p-3">'
                                    .$row['description'].
                                '</p>
                                
                                <div class="p-3">
                                    <span>⏱️ '.$row['time'].'</span>
                                    <span>📜 '.$row['difficulty'].'</span>';
                                    if(isset($_SESSION['admin'])) {
                                        echo '<div class="my-3">
                                        <a href="update_recipe.php?id='.$row['recipe_id'].'" type="button" class="btn btn-success m-3">Update</a>
                                        <a href="delete_recipe.php?id='.$row['recipe_id'].'" type="button" class="btn btn-danger m-3">Delete</a>
                                        </div>';
                                    } 
                                   echo '
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 pt-4" style="display:none">
                        <div class="col-sm-8 food">';
                        $i=1;
                        while($rowsteps = mysqli_fetch_assoc($resultstep)) {
                            echo '<h1><span class="border-bottom border-warning pr-5">Step '.$i.'</span></h1>
                                  <p>'.$rowsteps['description'] .'</p>
                                <br>';
                            $i++;
                        }
                        echo '</div>
                            <div class="col-sm-3 m-2">
                                <span><i class="fa fa-minus-circle"></i></span><span class="mx-2"> A DISH FOR '.$row['dish'].' </span><span><i class="fa fa-plus-circle"></i></span>';

                            while($rowingr = mysqli_fetch_assoc($resultingr)) {
                            echo '<div>
                                    <span>'.$rowingr['amount'].'  '.$rowingr['unit'].'</span>
                                    <span>'.$rowingr['description'].'</span>
                                  </div>';
                            }
                            echo 
                        '</div>
                    </div>
                ';
            }

            // Free result set
            mysqli_free_result($result);
            // Close connection
            mysqli_close($conn);
        ?>
        </div>
    </div>
    <!-- Main Content -->

    <!-- Modal Contact -->
    <?php include 'contact.php'; ?>


    <!-- Footer -->
    <?php include 'footer.php'; ?>



</body></html>

<?php ob_end_flush(); ?>

<!-- JavaScript -->
<script src="js/recipes.js"></script>
<script src="js/main.js"></script>