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
    <!-- JavaScript -->
    <script defer="" src="js/main.js"></script>
    <script defer="" src="js/recipes.js"></script>

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

    <div class="container mx-auto my-5">
        <div class="mx-auto">
            <h1 class="text-center font-weight-bold">There´re so many Recipes</h1>
            <p class="p-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat.
            </p>
        </div>
        <div  class="container-fluid row row-cols-1 row-cols-md-1 row-cols-lg-1 mx-auto my-4">
            <?php
            $sql = "SELECT * FROM recipes";
            $result = mysqli_query($conn, $sql);
            // fetch the next row (as long as there are any) into $row
            while($row = mysqli_fetch_assoc($result)) {
                echo "
                <button class="accordion mx-auto">
                    <div class="row">
                        <div class="col-sm-4">
                            <img class="card-img h-75" src="img/coverCaulifilower.png" alt="">
                        </div>
                        <div class="col-sm-8">
                            <h1 class="mb-4">Cauliflower &amp; Mushroom</h1>
                            <p class="p-3">
                                Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. Lorem ipsum dolor sit amet,
                                consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Lorem
                                ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            
                            <div class="accordion-preview-text-stats">
                                <span>⏱️ 1 hour 40 mins</span>
                                <span>📜 Hard</span>
                            </div>
                        </div>
                    </div>
                </button>
                <div class="row">
                    <div class="col-sm-8">
                        <?php 
                            for($i = 1 ; $i<count(result_steps); $i++)
                            echo '<h2>Step. </h2>'.$i;
                            echo '<hr>';
                            echo rowsepts['<p>description</p>'];
                        ?>
                    </div>
                </div>

                <div class='col mb-4'>
                    <div class='card h-100'>
                        <img src=img/".$row['image']." class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h4 class='card-title text-danger name'>". $row['name']."</h4>
                            <p class='card-text desc'>". $row['description']."</p>
                            <h5 class='card-text'>Available from: <i class='fa fa-calendar-o text-danger' aria-hidden='true'></i>". $row['date_from']."</h5>
                        </div>  
                        <div class='card-footer text-center p-1'>
                            <a class='text-info font-weight-bold mr-4' href='update.php?id=".$row['product_id']."'>
                                <i class='fa fa-info-circle' aria-hidden='true'></i> Product details</a>
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
           <!-- <button class="accordion mx-auto">
                <div class="row">
                    <div class="col-sm-4">
                        <img class="card-img h-75" src="img/coverCaulifilower.png" alt="">
                    </div>
                    <div class="col-sm-8">
                        <h1 class="mb-4">Cauliflower &amp; Mushroom</h1>
                        <p class="p-3">
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Lorem ipsum dolor sit amet,
                            consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Lorem
                            ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.
                        </p>
                        
                        <div class="accordion-preview-text-stats">
                            <span>⏱️ 1 hour 40 mins</span>
                            <span>📜 Hard</span>
                        </div>
                    </div>
                </div>
            </button>
            <div class="row">
                <div class="col-sm-8">
                    <?php 
                        /*for($i = 1 ; $i<count(result_steps); $i++)
                        echo '<h2>Step. </h2>'.$i;
                        echo '<hr>';
                        echo rowsepts['<p>description</p>'];*/
                    ?>
                </div>  
                <div class="col-sm-4">
                    <div class="panel-ingredients-title-dish">
                        <h2 class="border border-bottom-warning">- a dish for 3 +</h2>
                    </div>
                    <hr>
                    <div class="panel-ingredients-list">
                       
                        <ul class="panel-ingredients-left">
                            <li>0.2</li>
                            <li>50</li>
                            <li>20</li>
                            <li>120</li>
                            <li>1</li>
                            <li>2</li>
                            <li>2</li>
                        </ul>
                        <ul class="panel-ingredients-mid">
                            <li>kg</li>
                            <li>g</li>
                            <li>g</li>
                            <li>ml</li>
                            <li>TL</li>
                            <li>TL</li>
                            <li>TL</li>
                        </ul>
                        <ul class="panel-ingredients-right">
                            <li>Cauliflower</li>
                            <li>Minced Mushroom</li>
                            <li>Oyster Mushroom</li>
                            <li>Onion</li>
                            <li>Paprika</li>
                            <li>Sour Cream</li>
                            <li>Cheese</li>
                        </ul>
                    </div>
                </div>
            </div>        
        </div>
    </div>-->

    <!-- Main Content -->

    <!-- Modal Contact -->
    <?php include 'contact.php'; ?>


    <!-- Footer -->
    <?php include 'footer.php'; ?>



</body></html>

<?php ob_end_flush(); ?>