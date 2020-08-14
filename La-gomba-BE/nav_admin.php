<nav class="navbar navbar-expand-sm navbar-dark bgg1">
    <div class="navbar-brand ml-4">
        <img class="img-fluid" src="img/LaGomba.png" alt="">
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="products.php">PRODUCTS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="create_product.php">NEW PRODUCT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="recipes.php">RECIPES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="create_recipe.php">NEW RECIPE</a>
            </li>
        </ul>
    </div>
    <span class="ml-auto text-white mr-3 ">
          <?php if (isset($_SESSION['admin'])) {
                    echo 'Hi '.$userRow['userName']; 
                }
            ?> 
    </span>
    <?php
        if(!isset($_SESSION['admin'])) {
            echo '<a href="login.php" class="nav-link font-weight-bold btn btn-outline-warning">Login</a>';
        } else {
            echo '<a href="logout.php?logout" class="nav-link font-weight-bold btn btn-outline-warning">Log out</a>';  
        }
    ?>
</nav>