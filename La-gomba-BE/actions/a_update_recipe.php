<?php
    ob_start();
    session_start();
    require_once 'db_connect.php'; 

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        header("Location: ../login.php");
        exit;
    } 
?>

<?php		
	if ($_POST) {
		$id = $_POST['recipe_id'];
		$name = mysqli_real_escape_string($conn, $_POST['name']);
        $time = mysqli_real_escape_string($conn, $_POST['time']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);
        $difficulty = mysqli_real_escape_string($conn, $_POST['difficulty']);
        $dish = mysqli_real_escape_string($conn, $_POST['dish']);
        

        $sql = "UPDATE recipes SET name = '$name', time = '$time', description = '$description', image = '$image' , difficulty = '$difficulty' , dish = '$dish'
    		WHERE recipe_id = {$id}";
        
        if(mysqli_query($conn, $sql) === TRUE) {
            $removesteps = "DELETE from recipe_steps where recipe_id = {$id}";
            if (mysqli_query($conn, $removesteps)) {
                foreach($_POST['recipes_description'] as $step) {
                    if($step !== ''){
                        $sql = "INSERT INTO recipe_steps (recipe_id, description) VALUES ('$id', '$step')";
                        if (!mysqli_query($conn, $sql)) {
                            die('Invalid query: ' . mysql_error());
                        }
                    }
                }
            }

            $removeings = "DELETE from recipe_ingredients where recipe_id= {$id}";

            if (mysqli_query($conn, $removeings)) {
                for($i = 0 ; $i < count($_POST['ing_amount']); $i++) {
                    if($_POST['ing_amount'][$i] !== '' && $_POST['ing_unit'][$i] !== '' && $_POST['ing_description'][$i] !== '') {
                        $amount = $_POST['ing_amount'][$i];
                        $unit = $_POST['ing_unit'][$i];
                        $description = $_POST['ing_description'][$i];
                        $sql = "INSERT INTO recipe_ingredients (recipe_id, amount, unit, description) VALUES ('$id', '$amount', '$unit', '$description')";
                        if (!mysqli_query($conn, $sql)) {
                            die('Invalid query: ' . mysql_error());
                        }
                    }
                }
            }

           echo  "Successfully Updated";
        } else {
            echo "Error while updating : ". mysqli_error($conn);
        }
        mysqli_close($conn);
    }
?>

<?php ob_end_flush(); ?>