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
        <a class="nav-link" href="index.php">
          <p><b>home</b></p>
        </a>
        <a class="nav-link" href="product.php">
          <p><b>products</b></p>
        </a>
        <a class="nav-link" href="recipes.php">
          <p><b>recipes</b></p>
        </a>
        <a class="nav-link" href="aboutme.php">
          <p><b>about me</b></p>
        </a>
        <a class="nav-link" id="contact-show">
          <p><b>contact</b></p>
        </a>
        <?php
        if(!isset($_SESSION['user'])) {
            echo '<div class="nav-link-contact">
                  <p><a href="login.php"><b>login</b></a></p>
                </div>';
        } else {
          echo '<a class="nav-link" href="logout.php?logout" >
                  <p><b>log out</b></p>
                </a>';
        }
        ?>
      </div>
    </div>
  </nav>
  <!-- Main Navbar -->