<?php
    ob_start();
    session_start(); // start a new session or continues the previous
    if( isset($_SESSION['user'])!="" ){
        header("Location: index.php" ); // redirects to home.php
    }
    include_once 'actions/db_connect.php';
    $error = false;
    if ( isset($_POST['btn-signup']) ) {

        // sanitize user input to prevent sql injection
        $name = trim($_POST['name']);

        //trim - strips whitespace (or other characters) from the beginning and end of a string
        $name = strip_tags($name);

        // strip_tags — strips HTML and PHP tags from a string

        $name = htmlspecialchars($name);
        // htmlspecialchars converts special characters to HTML entities
        $email = trim($_POST[ 'email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);

        $pass = trim($_POST['pass']);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass);

        // basic name validation
        if (empty($name)) {
            $error = true ;
            $nameError = "Please enter your full name.";
        } else if (strlen($name) < 3) {
            $error = true;
            $nameError = "Name must have at least 3 characters.";
        } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
            $error = true ;
            $nameError = "Name must contain alphabets and space.";
        }

        //basic email validation
        if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $error = true;
            $emailError = "Please enter valid email address." ;
        } else {
            // checks whether the email exists or not
            $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);
            if($count!=0){
                $error = true;
                $emailError = "Provided Email is already in use.";
            }
        }
        // password validation
        if (empty($pass)){
            $error = true;
            $passError = "Please enter password.";
        } else if(strlen($pass) < 6) {
            $error = true;
            $passError = "Password must have atleast 6 characters." ;
        }

        // password hashing for security
        $password = hash('sha256' , $pass);

        // if there's no error, continue to signup
        if( !$error ) {

        $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
        $res = mysqli_query($conn, $query);
            if ($res) {
                $errTyp = "success";
                $errMSG = "Successfully registered, you may login now";
                unset($name);
                unset($email);
                unset($pass);
                header("Refresh: 2; url=login.php");
            } else  {
                $errTyp = "danger";
                $errMSG = "Something went wrong, try again later..." ;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<?php include 'head.php'; ?>
<body>
  
    <div class="container font-weight-bold mx-auto bg-dark my-3 py-3">
        <h3 class="text-center text-red my-3"><?php if ( isset($errMSG) ) {echo  $errMSG; }?></h3>
        <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
            <h3 class="text-center text-warning">Register</h3>
            <div class="form-group col-sm-5 mx-auto px-0">
                <label for="name" class="text-white">Your name:</label><br>
                <input type="text" name="name" id="name" class="form-control" placeholder= "Enter Full Name" value="<?php echo $name;?>" maxlength="50">
                <span class="text-danger"><?php  echo $nameError; ?></span >
            </div>
            <div class="form-group col-sm-5 mx-auto px-0">
                <label for="phone" class="text-white">Phone Number:</label><br>
                <input type="text" name="phone" id="phone" class="form-control" placeholder= "Your phone number" value="<?php echo $phone;?>" maxlength="50">
                <span class="text-danger"><?php  echo $nameError; ?></span >
            </div>
            <div class="form-group col-sm-5 mx-auto px-0">
                <label for="address" class="text-white">Address:</label><br>
                <input type="text" name="address" id="address" class="form-control" placeholder= "Enter your address" value="<?php echo $address;?>" maxlength="50">
                <span class="text-danger"><?php  echo $nameError; ?></span >
            </div>
            <div class="form-group col-sm-5 mx-auto px-0">
                <label for="username" class="text-white">Email:</label><br>
                <input type="email" name="email" id="email" class="form-control" placeholder= "Enter Your Email" value="<?php echo $email;?>" maxlength="40">
                <span class="text-danger"><?php  echo $emailError; ?></span >
            </div>
            <div class="form-group col-sm-5 mx-auto px-0">
                <label for="password" class="text-white">Password:</label><br>
                <input type="password" name="pass" id="password" class="form-control" placeholder="Enter Password"  maxlength="15">
                <span class="text-danger"><?php  echo $passError; ?></span>
            </div>
            <div class="form-group col-sm-5 mx-auto px-0">
                <label for="remember-me" class="text-white my-auto"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
            </div>
            <div class="form-group col-sm-5  mx-auto px-0">  
                <input type="submit" name="btn-signup" class="btn btn-warning btn-md mb-2" value="Sign Up">
                <a href="login.php" class=" btn btn-outline-warning btn-md mb-2">
                Sign in here 
                </a>
            </div>
        </form>
    </div>  
</body >
</html >
<?php  ob_end_flush(); ?>