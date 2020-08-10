<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>LaGomba</title>
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</head>
<body>

 
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand"><img src="/img/LaGomba-logo-sm.png" alt="lagomba-logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="aboutme.php">About Me</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="recipes.php">Recipes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container contact-form">

            <div class="contact-image">
                <img src="assets/img/mushroom.png"/>
            </div>
            <form (ngSubmit)="onSubmit(form)" #form="ngForm">
                <h3>Get in Touch!</h3>
               <div class="row">
                    <div class="col-md-6">

                        <span class="help-block" *ngIf="nameCtrl.invalid && nameCtrl.touched">
                          Name!
                        </span>
                        <div class="form-group">
                            <input type="text" name="txtName" class="form-control" placeholder="Your Name *"  ngModel required #nameCtrl="ngModel"/>
                        </div>
                       

                        <span class="help-block" *ngIf="emailCtrl.invalid && emailCtrl.touched">
                          EMail!
                        </span>
                        <div class="form-group">
                            <input type="text" name="txtEmail" class="form-control" placeholder="Your Email *"  ngModel required #emailCtrl="ngModel"/>
                        </div>

                        
                       
                    </div>
                    <div class="col-md-6">

                        <span class="help-block" *ngIf="textCtrl.invalid && textCtrl.touched">
                          Enter Message!
                        </span>
                        <div class="form-group">
                            <textarea name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;" ngModel required #textCtrl="ngModel"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="btnSubmit" class="btn btn-warning" value="Send Message" />
                        </div>
                    </div>

                    
                </div>
            </form>

</div>





<!-- Footer -->
<footer class="page-footer font-small .bg-light pt-4">

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-6 mt-md-0 mt-3">

        <!-- Content -->
        <h5 class="text-uppercase">Footer</h5>
        <p>Mushroom Footer</p>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase">Links</h5>

       

      </div>
      <!-- Grid column -->

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright: La Gomba
    
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->





























</body>
</html>