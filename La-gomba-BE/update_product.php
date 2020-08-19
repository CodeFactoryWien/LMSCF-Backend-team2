<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        header("Location: login.php");
        exit;
    } 

    if( isset($_SESSION['admin']) ) {
      // select logged-in users details
      $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
      $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
    }

     if ($_GET['id']) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM products WHERE product_id = {$id}" ;
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);
       
        mysqli_close($conn);
  
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
    <div class="container mx-auto bg-dark font-weight-bold my-4 py-3 text-warning">
        <form action="actions/a_update_product.php" method ="post" id="productDataUpdate">
            <input type= "hidden" name="product_id" value="<?php echo $data['product_id'] ?>" />
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4 mb-2">
                    <label for="name">Name: </label>
                    <input type="text" class="form-control" name="name" placeholder="Mushroom Name" value="<?php echo $data['name'] ?>">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="quality">Quality: </label>
                    <input type="text" class="form-control" name="quality" placeholder="Quality" value="<?php echo $data['quality'] ?>">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4 mb-2">
                    <label for="price">Price: </label>
                    <input type="text" class="form-control" name="price" 
                    placeholder="Product price" value="<?php echo $data['price'] ?>">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="date_from">Available from: </label>
                    <input type="date" class="form-control" name="date_from" placeholder="Available from this date" value="<?php echo $data['date_from'] ?>">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-4 mb-2">
                    <label for="amount">Amount: </label>
                    <input type="text" class="form-control" name="amount" placeholder="Mushroom amount" value="<?php echo $data['amount'] ?>">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="unit">Unit: </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01"  name="unit">
                            <option <?php if($data['unit']==='g') echo 'selected'; ?> value="g">Gram</option>
                            <option <?php if($data['unit']==='kg') echo 'selected'; ?> value="kg">Kg</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-8 mb-5 mx-auto px-0">
                <label for="description">Description: </label>
                <textarea type="text" class="form-control" name="description" placeholder="Mushroom short description"><?php echo $data['description'] ?></textarea> 
            </div>
            <div class="form-row justify-content-center mb-5">
                <input type="hidden" id="image" name="image" value="<?php echo $data['image'] ?>">
                <form method="post" action="" enctype="multipart/form-data" id="myform">
                    <div class='preview-update col-sm-4 mb-2 w-50'>
                        <img src="<?php echo $data['image'] ?>" id="img" class="w-100 h-100" >
                    </div>
                    <div class="col-sm-4 mb-2 w-50">
                        <input type="file" id="file" name="file"/>
                        <input type="button" class="btn btn-warning mt-2" value="Upload Image" id="but_upload">
                    </div>     
                </form>
            </div>
            <div class="form-group col-md-4 mx-auto">
                <input type="submit" class="btn btn-warning form-control font-weight-bold" id="productDataUpdateButton" value="Update Product">
            </div>

        </form>
    </div>

    
    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="js/products.js"></script>
</body>
</html>

<?php
}
?>
<?php ob_end_flush(); ?>