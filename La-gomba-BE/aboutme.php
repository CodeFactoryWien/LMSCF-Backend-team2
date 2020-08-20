<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    if(isset($_SESSION['admin'])) {
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
        if(isset($_SESSION['user'])) {
          include 'nav_user.php';
        } else {
          include 'nav_admin.php';
        }
    ?>

    <!-- Main Content -->
    <div class="container mx-auto my-4">
        <div class="container main mx-auto my-5 p-4">
            <h1 class=" text-center font-weight-bold mb-4">
                WHO IS NORA?
            </h1>
            <p class="p-3">
                Nora decided to act on her Climate Grief and started looking for
                solutions that are doing good for the environment and somewhat
                profitable. She wanted to help lowering meat consumption and at
                the same time clean the environment. Months of research has
                started and finally the answer was: A Vienna based company called
                Hut&amp;Stiel that recycles coffee waste and turns it into delicious
                Oyster mushroom. Nora started her internship at the company right
                away.
            </p>
            <h3 class="font-weight-bold mb-2">
                HOW IT ALL STARTED?
            </h2>
            <p class="p-3">
                In the 3rd district of Vienna in Markhofgasse there is a coworking
                space full of vibrant people with life and energy. Apart from the
                many people there are many spaces also. At the end of 2019 in one
                of the basements that is not too big and not too small renewal
                working has started. Viennese people like to drink coffee. They
                like to drink coffee a lot and there are thousands of kilograms of
                coffee grounds ending up in the trash day by day.
            </p>
            <h3 class="font-weight-bold mb-2">
                HOW DOES IT WORK?
            </h3>
            <p class="p-3">
                Instead of going to the garbage the daily collected coffee grounds
                go to Hut &amp; Stiel's production site where they are carefully
                turned in to mushroom substrate. The substrate goes in to bags and
                the bags go in to the incubational room. After 3 weeks of
                incubating they go to Nora's basement to fruit and to be
                harvested.
             </p>
            <h3 class="font-weight-bold mb-2">
                TIME TO START!
            </h3>
            <p class="p-3">
                After months of hammering, disassembling, assembling, painting,
                cleaning, drilling, cleaning, fixing and then cleaning the
                basement started to appear like a 70 square meters mushroom farm.
             </p>
            <h3 class="font-weight-bold mb-2">
                THE FIRST BAGS HAS ARRIVED!
            </h3>
            <p class="p-3">
                Nora started the production with 50 bags of incubated oyster
                mushroom (Pleurotus ostreatus) and 4 bags of Lion's Mane (Hericium
                erinaceus) that are from a Hungarian mushroom company. LaGomba
                Urban Mushroom
            </p>
            <h3 class="font-weight-bold mb-2">
                ARE YOU INTERESTED?
            </h3>
            <p class="p-3">
                If you would like to order fresh urban farmed eco-friendly Oyster
                Musrhoom, please contact Nora.
                email: rr.noar@gmail.com LaGomba Urban Mushroom
            </p>
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