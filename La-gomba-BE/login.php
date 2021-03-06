<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // it will never let you open login page if session is set
    if (isset($_SESSION['user'])!="") {
        header("Location: index.php");
        exit;
    }else if(isset($_SESSION['admin'])!=""){
        header("Location: products.php");
        exit;
    }

    $error = false;

    if( isset($_POST['btn-login']) ) {

        // prevent sql injections/ clear user invalid inputs
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);

        $pass = trim($_POST[ 'pass']);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass);
        // prevent sql injections / clear user invalid inputs

        if(empty($email)){
        $error = true;
        $emailError = "Please enter your email address.";
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $error = true;
            $emailError = "Please enter valid email address.";
        }   

        if (empty($pass)){
            $error = true;
            $passError = "Please enter your password." ;
        }

        // if there's no error, continue to login
        if (!$error) {
            $password = hash( 'sha256', $pass); // password hashing
            $res=mysqli_query($conn, "SELECT * FROM users WHERE userEmail='$email'" );
            $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
            $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row

            if( $count == 1 && $row['userPass' ]==$password ) {
                if ($row["status"] == 'admin'){
                    $_SESSION["admin"] = $row['user_id'];
                    header( "Location: products.php");  
                }else {
                    $_SESSION['user'] = $row['user_id'];
                    $_SESSION['products']=array();
                    header( "Location: index.php");    
                }
                
            }else {
                $errMSG = "Incorrect Credentials, Try again..." ;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body>
    <div class="container mx-auto my-5 w-75 bg-dark py-3">
        <h3 class="text-center text-danger my-3"><?php if ( isset($errMSG) ) {echo  $errMSG; }?></h3>
        <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
            <h3 class="text-center text-warning mb-3">Login</h3>
            <div class="form-group col-sm-5 mx-auto px-0">
                <label for="username" class="text-white">Username:</label><br>
                <input type="email" name="email" id="email" class="form-control" placeholder= "Your Email" value="<?php echo $email;?>" maxlength="40">
                <span class="text-danger"><?php  echo $emailError; ?></span >
            </div>
            <div class="form-group col-sm-5 mx-auto px-0">
                <label for="password" class="text-white">Password:</label><br>
                <input type="password" name="pass" id="password" class="form-control" placeholder="Your Password"  maxlength="15">
                <span class="text-danger"><?php  echo $passError; ?></span>
            </div>
            <div class="form-group col-sm-5 mx-auto px-0">
                <label for="remember-me" class="text-white my-auto"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
            </div>
            <div class="form-group col-sm-5 mx-auto px-0">  
                <input type="submit" name="btn-login" class="btn btn-warning btn-md mb-2" value="Sign In">
                <a href="register.php" class=" btn btn-outline-warning btn-md mb-2">
                Sign up here 
                </a>
            </div>
        </form>
          
    </div> 
</body>
</html>
<?php ob_end_flush(); ?>