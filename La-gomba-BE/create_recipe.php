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
    <div class="container mx-auto font-weight-bold mt-2 bg-dark text-white py-3 my-4">
        <form action="actions/a_create_recipe.php" method ="post" >
        <hr>
            <label class="text-warning">Recipe Details: </label>
        <hr> 
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
            <div class="form-group col-sm-8 mb-2 mx-auto px-0">
                <label for="image">Image: </label>
                <input type="url" class="form-control" name="image" placeholder="product image path">
            </div>
            <div class="form-group col-sm-8 mb-2 mx-auto px-0">
                <label for="description">Description: </label>
                <textarea type="text" class="form-control" name="description" placeholder="Recipe short description"></textarea> 
            </div>
            <hr>
                <label class="text-warning">Recipe Steps: </label>
            <hr>
            <div class="form-group col-md-8 mb-2 mx-auto">
                <div id="recipes_steps" name="recipes_steps">
                    <label>Step1: </label>
                    <input type="text" class="form-control" id="recipes_description" name="recipes_description[]">
                </div>
                <button id="add_steps" class="btn btn-success mt-1">Add New Step</button>
            </div>
            <hr>
                <label class="text-warning">Recipe Ingredients: </label>
            <hr>
            <div class="form-group col-md-8 mb-2 mx-auto">
                <div id="recipes_ingredients" name="recipes_ingredients">
                    <label>Ingredient 1:</label><br>
                    <label>Amount 1:</label>
                    <input type="text" class="form-control" id="ingredients" name="ing_amount[]">
                    <label>Unit 1:</label>
                    <input type="text" class="form-control" name="ing_unit[]">
                    <label>Name 1:</label>
                    <input type="text" class="form-control" name="ing_description[]">
                </div>
                <button id="add_ingredients" class="btn btn-success mt-1">Add New Ingredient</button>
            </div>
            <div class="form-group col-md-5 mx-auto px-0">
                <input type="submit" class="btn btn-success form-control" value="Submit">
            </div>
        </form>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

</body></html>

<?php ob_end_flush(); ?>

<script src="js/recipes.js"></script>