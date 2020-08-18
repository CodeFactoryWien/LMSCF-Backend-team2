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

        $sql = "SELECT * FROM recipes WHERE recipe_id = {$id}" ;
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);

        $sqlstep = "SELECT description FROM recipe_steps where recipe_id = {$id}";
        $resultstep = mysqli_query($conn, $sqlstep);
        $rowsteps = mysqli_fetch_assoc($resultstep);
        $sqlingr = "SELECT * FROM recipe_ingredients where recipe_id = {$id}";
        $resultingr = mysqli_query($conn, $sqlingr);
    
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

    <div class="container mx-auto font-weight-bold mt-2 bg-secondary py-3 my-4">
        <form action="actions/a_update_recipe.php" method ="post" id="recipeDataUpdate">
            <input type= "hidden" name="recipe_id" value="<?php echo $data['recipe_id'] ?>" />
        <hr>
            <label class="text-warning">Recipe Details: </label>
        <hr> 
        <div class="form-row justify-content-center"> 
            <div class="form-group col-md-4 mb-2">
                <label for="name">Name: </label>
                <input type="text" class="form-control" name="name" placeholder="Mushroom Name" value="<?php echo $data['name'] ?>">
            </div>
            <div class="form-group col-md-4 mb-2">
                <label for="time">Time: </label>
                <input type="text" class="form-control" name="time" placeholder="Time of cooking" value="<?php echo $data['time'] ?>">
            </div>  
        </div>
        <div class="form-row justify-content-center"> 
            <div class="form-group col-md-4 mb-2">
                <label for="difficulty">Difficulty: </label>
                <input type="text" class="form-control" name="difficulty" 
            placeholder="Recipe difficulty: hard, medium, easy" value="<?php echo $data['difficulty'] ?>">
             </div>
             <div class="form-group col-md-4 mb-2">
                <label for="dish">Portion: </label>
                <input type="number" class="form-control" name="dish" placeholder="Recipe portion, for 1 or 2, ... persons" value="<?php echo $data['dish'] ?>">
             </div> 
        </div>
            <div class="form-group col-sm-8 mb-2 mx-auto px-0">
                <label for="image">Image: </label>
                <input type="url" class="form-control" name="image" placeholder="product image path" value="<?php echo $data['image'] ?>">
            </div>
            <div class="form-group col-sm-8 mb-2 mx-auto px-0">
                <label for="description">Description: </label>
                <textarea type="text" class="form-control" name="description" placeholder="Recipe short description"><?php echo $data['description'] ?></textarea> 
            </div>
            <hr>
                <label class="text-warning">Recipe Steps: </label>
            <hr>
            <div class="form-group col-md-8 mb-2 mx-auto" id="add_steps_div">
            <?php
                $i=1;
                foreach ($rowsteps as $rowstep) {
                echo '
                <div id="recipes_steps_'.$i.'" name="recipes_steps">
                    <label>Step'.$i.': </label>
                    <input type="text" class="form-control" id="recipes_description" name="recipes_description[]" value="'.$rowstep.'">
                    <input onclick="remove(recipes_steps_'.$i.')" type="button" class="btn-danger" value="remove">
                </div>';
                $i++;
                }
            ?>
            </div>
            <button id="add_steps" class="btn btn-success mx-auto">Add Steps to Recipe</button>
            <hr>
                <label class="text-warning">Recipe Ingredients: </label>
            <hr>
            <div class="form-group col-md-8 mb-2 mx-auto" id="add_ings_div">
             <?php
                $i=1;
                while($rowingr = mysqli_fetch_assoc($resultingr)) {
                echo '
                <div id="recipes_ingredients_'.$i.'" name="recipes_ingredients">
                    <label>Ingredient '.$i.':</label><br>
                    <label>Amount '.$i.':</label>
                    <input type="text" class="form-control" id="ingredients" name="ing_amount[]"  value="'.$rowingr['amount'].'">
                    <label>Unit '.$i.':</label>
                    <input type="text" class="form-control" name="ing_unit[]" value="'.$rowingr['unit'].'">
                    <label>Name '.$i.':</label>
                    <input type="text" class="form-control" name="ing_description[]" value="'.$rowingr['description'].'">
                    <input onclick="removeing(recipes_ingredients_'.$i.')" type="button" class="btn-danger" value="remove">
                </div>
                ';
                $i++;
                }
            ?>
            </div>
            <button id="add_ingredients" class="btn btn-success mx-auto">Add Ingredients to Recipe</button>
            <div class="form-group col-md-5 mx-auto px-0">
                <input type="submit" class="btn btn-success form-control" value="Submit" id="recipeDataUpdateButton">
            </div>
        </form>
    </div>


    
    <!-- Footer -->
    <?php 
        include 'footer.php'; 
    ?>
</body>
</html>

<?php
mysqli_close($conn);
}
?>
<?php ob_end_flush(); ?>
<script type="text/javascript">
   function remove(data) {
        $(data).remove();
   } 
   function removeing(data) {
        $(data).remove();
   }  

    $("#add_steps").click(function (event) {
        event.preventDefault();
        let $i = $("#add_steps_div").find("div").length+1;
        $("#add_steps_div").append('<div id="recipes_steps_'+$i+'" name="recipes_steps">'+
                    '<label>Step'+$i+': </label>'+
                    ' <input type="text" class="form-control" id="recipes_description" '+
                    ' name="recipes_description[]" value="">'+
                    ' <input onclick="remove(recipes_steps_'+$i+')" type="button" class="btn-danger" value="remove">'+
                '</div>');
    });

    $("#add_ingredients").click(function (event) {
        event.preventDefault();
        let $i = $("#add_ings_div").find("div").length+1;
        $("#add_ings_div").append('<div id="recipes_ingredients_'+$i+'" name="recipes_ingredients">'+
                    '<label>Ingredient '+$i+':</label><br><label>Amount '+$i+':</label>'+
                    '<input type="text" class="form-control" id="ingredients" '+
                    'name="ing_amount[]"  value="">'+
                    '<label>Unit '+$i+':</label>'+
                    '<input type="text" class="form-control" name="ing_unit[]" '+
                    'value=""><label>Name '+$i+':</label>'+
                    '<input type="text" class="form-control" name="ing_description[]" '+
                    'value="">'+
                    '<input onclick="removeing(recipes_ingredients_'+$i+')" '+
                    'type="button" class="btn-danger" value="remove">'+
               ' </div>');
    });
</script>