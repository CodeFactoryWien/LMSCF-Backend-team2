<!-- Main Navbar -->
<nav id="navbar" class="wrapper-nav">
  <div class="nav-links">
    <div class="nav-left">
      <a href="index.php" class="wrapper-logo">
        <img class="logo-nav" src="img/logo-body.png" alt="">
        <img class="logo-nav" src="img/logo-arrow.png" alt="">
      </a>
    </div>
    <div class="nav-right">
      <a class="nav-link" href="product.php">
        <p><b>products</b></p>
      </a>
      <a class="nav-link" href="create_product.php">
        <p><b>new products</b></p>
      </a>
      <a class="nav-link" href="recipes.php">
        <p><b>recipes</b></p>
      </a>
      <a class="nav-link" href="create_recipe.php">
        <p><b>new recipe</b></p>
      </a>
    </div>
    <?php
      if(!isset($_SESSION['admin'])) {
          echo '<div class="nav-link-contact">
                <p><a href="login.php"><b>login</b></a></p>
              </div>';
      } else {
        echo '<div class="nav-link-contact">
                <p><a href="logout.php?logout"><b>logout</b></a></p>
              </div>';  
      }
    ?>
  </div>
</nav>