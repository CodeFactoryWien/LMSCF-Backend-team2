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
    <div class="container main mt-5 py-4">
        <h1>
            There´re so many Recipes
        </h1>
        <p class="py-3">
            Mushrooms are full of protein, fiber and many vitamins that makes
            them a perfect meat replacement and also can taste and feel like
            meat but has the benefits of a very low carbon footprint.
        </p>
    </div>  

    <div class="container mx-auto my-2">
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
                echo '<div class="accordion row reciCard bg-white my-4"> 
                        <img class="img-fluid col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 p-0" src="'.$row['image'].'" alt="'.$row['name'].'">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8  py-3 pl-5">
                            <h1 class="reciTitle">'
                                .$row['name'].
                            '</h1>
                            <p class="reciDescription">'
                                .$row['description'].
                            '</p>
                            
                            <div class="align-self-end">
                                <span class="reciDifficulty">⏱️ '.$row['time'].'</span>
                                <span>📜 '.$row['difficulty'].'</span>
                            </div>';
                                if(isset($_SESSION['admin'])) {
                                    echo '
                                    <div class="my-3">
                                        <a href="update_recipe.php?id='.$row['recipe_id'].'" type="button" class="btn btn-success py-2 px-3 m-2">Update</a>
                                        <a href="delete_recipe.php?id='.$row['recipe_id'].'" type="button" class="btn btn-danger py-2 px-3 m-2">Delete</a>
                                    </div>';
                                } 
                               echo '
                        </div>
                    </div>

                    <div class="row mt-4" style="display:none">
                        <div class="col-sm-8 col-md-8 col-lg-8">';
                        $i=1;
                        while($rowsteps = mysqli_fetch_assoc($resultstep)) {
                            echo '<span class="stepsTitel p-1 pr-4 my-2">Step '.$i.'</span>
                                <p class="stepsText mt-2">'.$rowsteps['description'] .'</p>
                                <br>';
                            $i++;
                        }

                        echo '</div>
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <span class="text-warning font-weight-bold border-bottom border-warning px-2">
                                        <span><i class="fa fa-minus-circle"></i></span>
                                        <span class="mx-2 reciFood">A DISH FOR '.$row['dish'].'</span>
                                        <span><i class="fa fa-plus-circle"></i></span>
                                    </span>';

                            while($rowingr = mysqli_fetch_assoc($resultingr)) {
                            echo '<div class="reciFood">
                                    <span >'.$rowingr['amount'].' '.$rowingr['unit'].'</span>
                                    <span class="ml-2">'.$rowingr['description'].'</span>
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