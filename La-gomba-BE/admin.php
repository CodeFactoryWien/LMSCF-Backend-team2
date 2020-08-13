<?php
  ob_start();
  session_start();
  require_once 'actions/db_connect.php';

  if( isset($_SESSION['admin']) ) {
    // select logged-in users details
    $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
  }
  
?>
<html lang="en">
<?php include 'head.php'; ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<body class="main">
  <!-- Header -->
  <?php include 'header.php'; ?>

  <!-- Main Navbar -->
  <?php include 'nav_admin.php'; ?>

  <!-- Main Content -->
  <main class="wrapper-main">
    <div id="result" class="container-fluid row row-cols-1 row-cols-md-2 row-cols-lg-3 mx-auto my-4">
        <?php
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);
            // fetch the next row (as long as there are any) into $row
            while($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class='col mb-4'>
                    <div class='card h-100'>
                        <img src=img/".$row['image']." class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h4 class='card-title text-danger name'>". $row['name']."</h4>
                            <p class='card-text desc'>". $row['description']."</p>
                            <h5 class='card-text'>Available from: <i class='fa fa-calendar-o text-danger' aria-hidden='true'></i>". $row['date_from']."</h5>
                        </div>  
                        <div class='card-footer text-center p-1'>
                            <a class='text-info font-weight-bold mr-4' href='update.php?id=".$row['animal_id']."'>
                                <i class='fa fa-info-circle' aria-hidden='true'></i> Event details</a>
                            <a class='text-warning font-weight-bold mx-auto' href='update.php?id=".$row['animal_id']."'>Edit <i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>
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
    </div>
  </main>
  <!-- Main Content -->


  <!-- Mobile Navbar -->
  <nav class="wrapper-mobile-nav">
    <div class="mobile-nav-links navbar">
      <div class="mobile-nav-link">
        <div class="mobile-nav-dropup">
          <div class="mobile-nav-dropbtn">
            More
          </div>
          <div class="mobile-nav-dropup-content left-drop">
            <a href="aboutme.php">about me</a>
            <a href="recipes.php">recipes</a>
          </div>
        </div>
      </div>
      <a class="mobile-nav-link" href="index.html">
        <div class="mobile-nav-link-text">
          <p class="">Home</p>
        </div>
      </a>
      <div class="mobile-nav-link">
        <div class="mobile-nav-dropup">
          <div class="mobile-nav-dropbtn">
            contact
          </div>
          <div class="mobile-nav-dropup-content right-drop">
            
            <a href="https://goo.gl/maps/ekBkVFXtCscuXGCv8" target="_blank">
              route</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- Mobile Navbar -->

  <!-- Footer -->
  <?php include 'footer.php'; ?>


</body></html>

<?php ob_end_flush(); ?>