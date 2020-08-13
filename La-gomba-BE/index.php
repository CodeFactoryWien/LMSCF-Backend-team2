<?php
  ob_start();
  session_start();
  require_once 'actions/db_connect.php';

  if( isset($_SESSION['admin']) && isset($_SESSION['user']) ) {
    // select logged-in users details
    $res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
  }
  
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body class="main">
  <!-- Header Parallax -->
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
    <div class="main-content">
      <div class="main-body">
        <div class="main-body-content">
          <h1>
            About the mushroom
          </h1>
          <p>
            Mushrooms are full of protein, fiber and many vitamins that makes
            them a perfect meat replacement and also can taste and feel like
            meat but has the benefits of a very low carbon footprint. Apart
            from this there are 6 surprising health benefit points from the
            Treehugger website:
          </p>
          <h3>
            1. They have cancer-fighting properties.
          </h3>
          <p>
            A study published in the journal Experimental Biology and Medicine
            tested five types of mushrooms (maitake, crimini, portabella,
            oyster and white button) and found that they "significantly
            suppressed" breast cancer cell growth and reproduction, suggesting
            "both common and specialty mushrooms may be chemoprotective
            against breast cancer."
          </p>
          <h3>
            2. Mushrooms are immunity-boosters.
          </h3>
          <p>
            We now know that lentinan can boost your immune system, but it has
            a helper, too. Beta-glucan is a sugar found in the cells walls of
            fungi (among other plants) that also helps boost your immune
            system. Lentinan comes from shiitake mushrooms, but beta-glucan is
            found in many varieties, namely the common button mushrooms.
          </p>
          <h3>
            3. They help lower cholesterol.
          </h3>
          <p>
            In general, mushrooms are cholesterol free, but they're also a
            good source of chitin and beta-glucan, which are fibers that lower
            cholesterol. A study in the International Journal of Medicinal
            Mushrooms in the International Journal of Medicinal Mushrooms
            found that pink oyster mushrooms reduced total cholesterol and LDL
            ("bad" cholesterol) in hypercholesterolemic rats.
          </p>
          <h3>
            4. They're high in B and D vitamins.
          </h3>
          <p>
            Mushrooms are one of the few food sources for vitamin D, a
            fat-soluble vitamin that our bodies can make with exposure to
            sunlight and vitamin B12, which is key for vegetarians as it's
            most often found in animal products.
          </p>
          <h3>
            5. Mushrooms have anti-inflammatory powers.
          </h3>
          <p>
            Mushrooms contain a powerful antioxidant called ergothioneine,
            which helps lower inflammation throughout the body. Multiple
            studies have shown that reishi mushrooms have multiple health
            benefits: They fight disease, lower inflammation, suppress
            allergic responses, reduce tumor growth and more.
          </p>
          <h3>
            6. They could help fight aging.
          </h3>
          <p>
            In a study at Penn State, researchers found that mushrooms have
            high amounts of two antioxidants, ergothioneine and glutathione,
            which are both associated with anti-aging properties. "What we
            found is that, without a doubt, mushrooms are [the] highest
            dietary source of these two antioxidants taken together, and that
            some types are really packed with both of them," said Robert
            Beelman, professor emeritus of food science and director of the
            Penn State Center for Plant and Mushroom Products for Health, in a
            statement. The amounts of the antioxidants vary by species; the
            winner "by far" was the wild porcini mushroom, researchers said.
            Similarly, a 2019 study found that seniors who ate more than 300
            grams of cooked mushrooms a week were half as likely to have mild
            cognitive impairment. The six-year study — conducted from 2011 to
            2017 — collected data from more than 600 seniors over the age of
            60 living in Singapore. The researchers looked at ergothioneine as
            the possible reason for this impact.
          </p>
        </div>
      </div>
    </div>
  </main>
  <!-- Main Content -->

  <!-- Modal Contact -->
  <div class="modal-contact modal-contact--hidden">
    <div class="modal-contents">
      <div class="modal-close-bar">
            <span class="modal-close-bar-x">
              X
            </span>
      </div>
      <div class="modal-logo-over">
        <div class="wrapper-modal-logo">
          <img class="modal-logo" src="img/logo-body.png" alt="">
          <img class="modal-logo" src="img/logo-arrow.png" alt="">
        </div>
      </div>
      <div>
        <h1>
          Get in touch!
        </h1>
      </div>
      <div class="wrapper-form">
        <form class="form-label" id="contact-modal">
          <div class="form-animated">
            <input class="form-bg" type="text" name="name" autocomplete="off" required="">
            <label for="name" class="label-name">
              <span class="content-name">Name</span>
            </label>
          </div>
          <div class="form-animated">
            <input class="form-bg" type="email" name="email" autocomplete="off" required="">
            <label for="email" class="label-name">
              <span class="content-name">Email</span>
            </label>
          </div>
          <div class="form-animated">
            <input class="form-bg" type="text" name="text" autocomplete="off" required="">
            <label for="name" class="label-name">
              <span class="content-name">Enter Message</span>
            </label>
          </div>
          <button class="form-button" type="submit">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Contact -->

  <!-- Mobile Navbar -->
  <nav class="wrapper-mobile-nav">
    <div class="mobile-nav-links navbar">
      <div class="mobile-nav-link">
        <div class="mobile-nav-dropup">
          <div class="mobile-nav-dropbtn">
            More
          </div>
          <div class="mobile-nav-dropup-content left-drop">
            <a href="aboutme.php">about me</a>
            <a href="recipes.php">recipes</a>
          </div>
        </div>
      </div>
      <a class="mobile-nav-link" href="index.html">
        <div class="mobile-nav-link-text">
          <p class="">Home</p>
        </div>
      </a>
      <div class="mobile-nav-link">
        <div class="mobile-nav-dropup">
          <div class="mobile-nav-dropbtn">
            contact
          </div>
          <div class="mobile-nav-dropup-content right-drop">
            
            <a href="https://goo.gl/maps/ekBkVFXtCscuXGCv8" target="_blank">
              route</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- Mobile Navbar -->

  <!-- Footer -->
  <?php include 'footer.php'; ?>


</body></html>

<?php ob_end_flush(); ?>