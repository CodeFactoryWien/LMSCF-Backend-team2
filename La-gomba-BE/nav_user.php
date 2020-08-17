<nav class="navbar navbar-expand-sm navbar-dark bgg1">
    <div class="navbar-brand ">
        <img class="img-fluid logo" src="img/LaGomba.png" alt="">
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php">HOME </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="products.php">PRODUCTS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="recipes.php">RECIPES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="aboutme.php">ABOUT ME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" id="contactButton">CONTACT</a>
            </li>
        </ul>
    </div>
    <span class="ml-auto text-white mr-3 font-weight-bold">
          <?php if (isset($_SESSION['user'])) {
                    echo 'Hi '.$userRow['userName']; 
                }
            ?> 
    </span>
    <?php
        if(!isset($_SESSION['user'])) {
            echo '
            <a class="nav-link font-weight-bold btn btn-outline-success mr-1" href="cart.php">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </a>
            <a href="login.php" class="nav-link font-weight-bold btn btn-outline-warning">Login</a>
                
            ';
        } else {
            echo '
            <a class="nav-link font-weight-bold btn btn-outline-success mr-1" href="cart.php">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </a>
            <a href="logout.php?logout" class="nav-link font-weight-bold btn btn-outline-warning ">Log out</a>
            ';  
        }
    ?>
</nav>
<script>

</script>