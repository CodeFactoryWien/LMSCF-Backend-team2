<?php
    ob_start();
    session_start();
    require_once 'actions/db_connect.php';

    // if session is not set this will redirect to login page
    if( !isset($_SESSION['admin']) ) {
        header("Location: login/login.php");
        exit;
    }

    // select logged-in admins details
    $sql = "SELECT * FROM users where user_id=".$_SESSION['admin'];
    $result = mysqli_query($conn, $sql);
    $userRow = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adopt-a-pet</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Adopt-pet-shop">
    <meta name="keywords" content="HTML, Bootstrap, MySQL, PHP">
    <meta name="author" content="Admir Saraseli">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <header>   
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="admin.php">All cuties <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="insert.php">Add a pet</a>
                    </li>
                </ul>  
            </div>
            <span class="ml-auto text-white mr-3">
                <img class="rounded" style="height: 40px; width: 40px" src="<?php echo $userRow['image'];?>">
                Hi <?php echo $userRow['userName']; ?>
            </span>
            <a href="login/logout.php?logout" class="nav-link  btn btn-outline-warning">Log out</a>
        </nav>
    </header>
    
    <div class="mx-auto font-weight-bold mt-2 w-50 bg-info py-3">
        <form action="actions/a_insert.php" method ="post" >
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
                    placeholder="Small, Large, Senior">
                </div>
                <div class="form-group col-md-4 mb-2">
                    <label for="date_from">Available from: </label>
                    <input type="date" class="form-control" name="date_from" placeholder="Available from this date">
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-8 mb-2 mx-auto px-0">
                    <label for="size">Size: </label>
                    <input type="text" class="form-control" name="size" placeholder="Mushroom size">
                </div>
                <div class="form-group col-md-8 mb-2 mx-auto px-0">
                    <label for="hobbies">Unit: </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01">
                            <option selected value="g">Gram</option>
                            <option value="kg">Kg</option>
                        </select>
                    </div>
                </div> 
            </div>
            <div class="form-group col-md-8 mb-2 mx-auto px-0">
                <label for="image">Image: </label>
                <input type="text" class="form-control" name="image" placeholder="Pet image path">
            </div>
            <div class="form-group col-md-8 mb-2 mx-auto px-0">
                <label for="description">Description: </label>
                <textarea type="text" class="form-control" name="description" placeholder="Mushroom short description"></textarea> 
            </div>
            <div class="form-group col-md-4 mx-auto">
                <input type="submit" class="btn btn-danger form-control" value="Submit">
            </div>
        </form>
    </div>
    <footer class="wrapper-footer">
        <div class="footer-header">
            <!-- Just a Color -->
        </div>
        <div class="footer-body">
            <div class="footer-body-up">
                <div class="footer-body-row">
                    <h5 class="footer-title">social media</h5>
                    <hr class="footer-title-underline">
                    <div class="footer-body-links">
                        <p class="footer-text fire">
                            <a class="footer-link" target="_blank" href="https://www.facebook.com/LaGomba-103065104591559">Facebook</a>
                        </p>
                    </div>
                </div>
                <div class="footer-body-row">
                    <h5 class="footer-title">products</h5>
                    <hr class="footer-title-underline">
                    <div class="footer-body-links">
                        <p class="footer-text mushroom">
                            <a class="footer-link" href="index.php">Mushrooms</a>
                        </p>
                        <p class="footer-text bulb">
                            <a class="footer-link" href="aboutme.php">About me</a>
                        </p>
                        <p class="footer-text scroll">
                            <a class="footer-link" href="recipes.php">Recipes</a>
                        </p>
                    </div>
                </div>
                <div class="footer-body-row">
                    <h5 class="footer-title">contact</h5>
                    <hr class="footer-title-underline">
                    <div class="footer-body-links">
                        <p class="footer-text">
                            Markhofgasse 19
                        </p>
                        <p class="footer-text">
                            Wien | 1030
                        </p>

                        <p class="footer-text">
                            <a class="footer-link" href="mailto:rr.noar@gmail.com">rr.noar@gmail.com</a>
                        </p>
                        <p class="footer-text"></p>
                    </div>
                </div>
            </div>
            <div class="footer-body-down">
                <div class="footer-body-row">
                    <h5 class="footer-title">lagomba</h5>
                    <hr class="footer-title-underline">
                    <div class="footer-body-links">
                        <iframe class="footer-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2659.6938790047197!2d16.406720115529684!3d48.19324935526099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476d075b1edff245%3A0xaef7a8ddf96bc82d!2sMarkhofgasse%2019%2C%201030%20Wien!5e0!3m2!1sde!2sat!4v1593439331736!5m2!1sde!2sat" frameborder="0" style="border: 0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="copyright-container">
                <p class="copyright-container-text footer-text">
                    © 2020 Copyright
                    <a class="copyright-container-link footer-link" href="index.php">
                         <img src="img/gombalogo.png" alt="lagomba">
                        LaGomba
                    </a>
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
<?php ob_end_flush(); ?>