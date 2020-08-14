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
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>

<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Main Navbar -->
    <?php
        if(!isset($_SESSION['admin'])) {
          include 'nav_user.php';
        } else {
          include 'nav_admin.php';
        }
    ?>

    <!-- Main Content -->
    <main class="wrapper-main">
        <div class="container mx-auto font-weight-bold mt-2 bg-info py-3">
            <form action="actions/a_create_recipe.php" method ="post" >   
                <div class="form-group col-sm-5 mb-2 mx-auto px-0">
                    <label for="name">Name: </label>
                    <input type="text" class="form-control" name="name" placeholder="Mushroom Name">
                </div>
                <div class="form-group col-sm-5 mb-2 mx-auto px-0">
                    <label for="time">Time: </label>
                    <input type="text" class="form-control" name="time" placeholder="Time of cooking">
                </div>  
                <div class="form-group col-sm-5 mb-2 mx-auto px-0">
                    <label for="difficulty">Difficulty: </label>
                    <input type="text" class="form-control" name="difficulty" 
                placeholder="Recipe difficulty: hard, medium, easy">
                 </div> 
                <div class="form-group col-sm-5 mb-2 mx-auto px-0">
                    <label for="image">Image: </label>
                    <input type="url" class="form-control" name="image" placeholder="product image path">
                </div>
                <div class="form-group col-sm-5 mb-2 mx-auto px-0">
                    <label for="description">Description: </label>
                    <textarea type="text" class="form-control" name="description" placeholder="Recipe short description"></textarea> 
                </div>
                <div class="form-group col-sm-5 mb-2 mx-auto px-0">
                    <label >Recipe Steps: </label>
                    <div id="recipes_steps" name="recipes_steps">
                        <label>Step1: </label>
                        <input type="text" class="form-control" id="recipes_description" name="recipes_description[]">
                    </div>
                    <button id="add_steps" class="btn btn-success">Add Steps to Recipe</button>
                </div>
                <div class="form-group col-sm-5 mb-2 mx-auto px-0">
                    <label >Recipe Ingredients: </label>
                    <div id="recipes_ingredients" name="recipes_ingredients">
                        <label>Ingredient 1:</label><br>
                        <label>Amount 1:</label>
                        <input type="text" class="form-control" id="ingredients" name="ing_amount[]">
                        <label>Unit 1:</label>
                        <input type="text" class="form-control" name="ing_unit[]">
                        <label>Name 1:</label>
                        <input type="text" class="form-control" name="ing_description[]">
                    </div>
                    <button id="add_ingredients" class="btn btn-success">Add Ingredients to Recipe</button>
                </div>
                <div class="form-group col-md-5 mx-auto px-0">
                    <input type="submit" class="btn btn-danger form-control" value="Submit">
                </div>
            </form>
        </div>
    </main>

     

    <!-- Footer -->
    <?php include 'footer.php'; ?>

</body></html>

<?php ob_end_flush(); ?>

<script type="text/javascript">
$("#add_steps").click(function (event) {
    event.preventDefault();
    let $i = $("#recipes_steps").find("input").length+1;
    $("#recipes_steps").append('<label>Step'+$i+':</label><input type="text" id="recipes_description" class="form-control" name="recipes_description[]">');
});

$("#add_ingredients").click(function (event) {
    event.preventDefault();
    let $i = $("#recipes_ingredients").find("#ingredients").length+1;
    $("#recipes_ingredients").append(
      '<label>Ingredient '+$i+': </label> <br>'+
      '<label>Amount '+$i+':</label>'+
      '<input type="text" id="ingredients" class="form-control" name="ing_amount[]">'+
      '<label>Unit '+$i+':</label>'+
      '<input type="text" class="form-control" name="ing_unit[]">'+
      '<label>Name '+$i+':</label>'+
      '<input type="text" class="form-control" name="ing_description[]">'
    );
});

  
</script>