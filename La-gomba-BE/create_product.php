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
    <div class="container mx-auto font-weight-bold mt-2 bg-dark text-warning py-3 my-4">
        <form action="actions/a_create_product.php" method ="post" id="productData">
            <div class="form-row justify-content-center">
                <div class="form-group col-sm-4 mb-2">
                    <label for="name">Name: </label>
                    <input type="text" class="form-control" name="name" placeholder="Mushroom Name">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="price">Price: </label>
                    <input type="text" class="form-control" name="price" 
                    placeholder="Product price">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4 mb-2">
                    <label for="quality">Quality: </label>
                    <input type="text" class="form-control" name="quality" placeholder="Quality">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="quality_description">Quality description: </label>
                    <input type="text" class="form-control" name="quality_description" placeholder="Quality description:">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4 mb-2">
                    <label for="date_from">Date from: </label>
                    <input type="date" class="form-control" name="date_from" placeholder="Available from this date">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="date_to">Date to: </label>
                    <input type="date" class="form-control" name="date_to" placeholder="To this date">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4 mb-2">
                    <label for="amount">Amount: </label>
                    <input type="text" class="form-control" name="amount" placeholder="Mushroom amount">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="hobbies">Unit: </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="unit">
                            <option selected value="kg">Kg</option>
                            <option value="g">Gram</option>
                        </select>
                    </div>
                </div> 
            </div>
            <div class="form-group col-md-8 mb-5 mx-auto px-0">
                <label for="description">Description: </label>
                <textarea type="text" class="form-control" name="description" placeholder="Mushroom short description" rows="3"></textarea>
            </div>
            <div class="form-row justify-content-center mb-5">
                <input type="hidden" id="image" name="image" value="">
                <form method="post" action="" enctype="multipart/form-data" id="myform">
                    <div class='preview col-sm-4 mb-2 w-50'>
                        <img src="" id="img" class="w-100 h-100" >
                    </div>
                    <div class="col-sm-4 mb-2 w-50">
                        <input type="file" id="file" name="file"/>
                        <input type="button" class="btn btn-warning btn-sm mt-2" value="Upload Image" id="but_upload">
                    </div>     
                </form>
            </div>
            <div class="form-group col-md-4 mx-auto">
                <input type="submit" class="btn btn-success form-control font-weight-bold" value="Create Product" id="productDataButton">
            </div>
        </form>
    </div>
    
    <!-- Footer -->
    <?php include 'footer.php'; ?>
<script type="text/javascript" src="js/products.js"></script>
</body>
</html>

<?php ob_end_flush(); ?>
