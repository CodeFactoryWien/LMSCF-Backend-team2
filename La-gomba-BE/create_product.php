<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        header("Location: login.php");
        exit;
    } 

    if( isset($_SESSION['admin'])) {
        // select logged-in users details
        $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    }
    
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body class="main">
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Main Navbar -->
    <?php
        include 'nav_admin.php';
    ?>

    <!-- Main Content -->
    <div class="container mx-auto font-weight-bold mt-2 bg-dark text-white py-3 my-4">
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
                    <select class="custom-select" id="inputGroupSelect01" name="unit">
                        <option selected value="g">Gram</option>
                        <option value="kg">Kg</option>
                    </select>
                </div>
            </div> 
            <div class="form-group col-md-8 mb-2 mx-auto px-0">
                <label for="image">Image: </label>
                <input type="text" class="form-control" name="image" placeholder="Product image path">
            </div>
            <div class="form-group col-md-8 mb-2 mx-auto px-0">
                <label for="description">Description: </label>
                <textarea type="text" class="form-control" name="description" placeholder="Mushroom short description"></textarea> 
            </div>
            <div class="form-group col-md-4 mx-auto">
                <input type="submit" class="btn btn-success form-control" value="Submit">
            </div>
        </form>
    </div>
    
    <form action="upload.php" method="post" enctype="multipart/form-data">
      Select image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload Image" name="submit">
    </form>
    
     

    <!-- Footer -->
    <?php include 'footer.php'; ?>

</body></html>

<?php ob_end_flush(); ?>