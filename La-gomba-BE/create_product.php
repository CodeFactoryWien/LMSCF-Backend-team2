<?php
  ob_start();
  session_start();
  require_once 'actions/db_connect.php';

  if( isset($_SESSION['admin']) && isset($_SESSION['user']) ) {
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
        <div class="container mx-auto font-weight-bold mt-2 bg-info py-3">
            <form action="actions/a_create_product.php" method ="post" >
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-4 mb-2">
                        <label for="name">Name: </label>
                        <input type="text" class="form-control" name="name" placeholder="Mushroom Name">
                    </div>
                    <div class="form-group col-md-4 mb-2">
                        <label for="quality">Quality: </label>
                        <input type="text" class="form-control" name="quality" placeholder="Quality">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-4 mb-2">
                        <label for="price">Price: </label>
                        <input type="text" class="form-control" name="price" 
                        placeholder="Product price">
                    </div>
                    <div class="form-group col-md-4 mb-2">
                        <label for="date_from">Available from: </label>
                        <input type="date" class="form-control" name="date_from" placeholder="Available from this date">
                    </div>
                </div>
                <div class="form-group col-md-8 mb-2 mx-auto px-0">
                    <label for="amount">Amount: </label>
                    <input type="text" class="form-control" name="amount" placeholder="Mushroom amount">
                </div>
                <div class="form-group col-md-8 mb-2 mx-auto px-0">
                    <label for="hobbies">Unit: </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01">
                            <option selected value="g">Gram</option>
                            <option value="kg">Kg</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group col-md-8 mb-2 mx-auto px-0">
                    <label for="image">Image: </label>
                    <input type="text" class="form-control" name="image" placeholder="Pet image path">
                </div>
                <div class="form-group col-md-8 mb-2 mx-auto px-0">
                    <label for="description">Description: </label>
                    <textarea type="text" class="form-control" name="description" placeholder="Mushroom short description"></textarea> 
                </div>
                <div class="form-group col-md-4 mx-auto">
                    <input type="submit" class="btn btn-danger form-control" value="Submit">
                </div>
            </form>
        </div>
    </main>

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