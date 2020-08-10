<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>LaGomba</title>
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" routerLink="/"><img src="../../assets/img/LaGomba_logo-removebg-preview.png" alt="lagomba-logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item" routerLinkActive='active' [routerLinkActiveOptions]="{exact: true}">
        <a class="nav-link" routerLink='/'>Home</a>
      </li>
      <li class="nav-item" routerLinkActive='active'>
        <a class="nav-link" routerLink="/about-mushrooms">About Mushrooms</a>
      </li>
      <li class="nav-item" routerLinkActive='active'>
        <a class="nav-link" routerLink='/about-us'>About Us</a>
      </li>
      <li class="nav-item" routerLinkActive='active'>
        <a class="nav-link" routerLink='/contact'>Contact</a>
      </li>
    </ul>
  </div>
</nav>

















</body>
</html>