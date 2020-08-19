<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        header("Location: login.php");
        exit;
    } 

    if(isset($_SESSION['admin'])) {
        $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
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
        include 'nav_admin.php';
    ?>

    <!-- Main Content -->
    <div class="container rounded mx-auto font-weight-bold mt-2 bg-dark text-white py-3 my-4">
        <form action="actions/a_create_recipe.php" method ="post" id="recipeData">
            <hr class="border border-warning">
                <label class="text-warning">Recipe Details: </label>
            <hr class="border border-warning"> 
            <div class="form-row justify-content-center"> 
                <div class="form-group col-md-4 mb-2">
                    <label for="name">Name: </label>
                    <input type="text" class="form-control" name="name" placeholder="Mushroom Name">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="time">Time: </label>
                    <input type="text" class="form-control" name="time" placeholder="Time of cooking">
                </div>  
            </div>
            <div class="form-row justify-content-center"> 
                <div class="form-group col-md-4 mb-2">
                    <label for="difficulty">Difficulty: </label>
                    <input type="text" class="form-control" name="difficulty" 
                placeholder="Recipe difficulty: hard, medium, easy">
                 </div>
                 <div class="form-group col-md-4 mb-2">
                    <label for="dish">Portion: </label>
                    <input type="number" class="form-control" name="dish" placeholder="Recipe portion, for 1 or 2, ... persons">
                 </div> 
            </div>
            <div class="form-group col-sm-8 mb-4 mx-auto px-0">
                <label for="description">Description: </label>
                <textarea type="text" class="form-control" name="description" placeholder="Recipe short description"></textarea> 
            </div>
            <hr class="border border-warning mt-4">
                <label class="text-warning">Recipe Steps: </label>
            <hr class="border border-warning mb-4">
            <div class="form-group col-md-8 mb-2 mx-auto">
                <div id="recipes_steps" name="recipes_steps">
                    <label>Step1: </label>
                    <input type="text" class="form-control mb-2" id="recipes_description" name="recipes_description[]">
                </div>
                <button id="add_steps" class="btn btn-warning mt-1">Add New Step</button>
            </div>
            <hr class="border border-warning mt-4">
                <label class="text-warning">Recipe Ingredients: </label>
            <hr class="border border-warning mb-4">
            <div class="form-group col-md-8 mb-4 mx-auto">
                <div id="recipes_ingredients" name="recipes_ingredients">
                    <label class="border border-warning p-2">Ingredient 1:</label><br>
                    <label>Amount 1:</label>
                    <input type="text" class="form-control mb-2" id="ingredients" name="ing_amount[]">
                    <label>Unit 1:</label>
                    <input type="text" class="form-control mb-2" name="ing_unit[]">
                    <label>Name 1:</label>
                    <input type="text" class="form-control mb-2" name="ing_description[]">
                </div>
                <button id="add_ingredients" class="btn btn-warning mt-1">Add New Ingredient</button>
            </div>
            <hr class="border border-warning mt-4">
                <label class="text-warning">Recipe image: </label>
            <hr class="border border-warning mb-4">
            <div class="form-row justify-content-center mb-5">
                <form method="post" action="" enctype="multipart/form-data" id="myform">
                    <div class='preview col-sm-4 mb-2 w-50'>
                        <img src="" id="img" class="w-100 h-100" >
                    </div>
                    <div class="col-sm-4 mb-2 w-50">
                        <input type="file" id="file" name="file"/>
                        <input type="button" class="btn btn-warning btn-sm mt-2" value="Upload Image" id="but_upload">
                    </div>     
                </form>
                <input type="hidden" id="image" name="image" value="">
            </div>
            <div class="form-group col-md-5 mx-auto px-0 mt-4">
                <input type="submit" class="btn btn-success form-control font-weight-bold" value="Create Recipe" id="recipeDataButton">
            </div>
        </form>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

</body></html>

<?php ob_end_flush(); ?>

<script src="js/recipes.js"></script>