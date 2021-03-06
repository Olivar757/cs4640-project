<!-- Navigation bar accquired from
bootstrap for the navigation bar at
   https://getbootstrap.com/docs/4.0/components/navbar/ 

Includes style sheet created by 
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
to modify the style of the nav bar for our website
--> 

<?php
  require('connectdb.php');
?>

<!--Link to our stylesheet we created-->
<link rel='stylesheet' href="styles.css">

<!-- We used bootstrap for the navigation bar at
   https://getbootstrap.com/docs/4.0/components/navbar/ -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Navigation Bar: 
   https://getbootstrap.com/docs/4.0/components/navbar/ -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class='navbar-brand'>SimpleEats</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
        <ul class='navbar-nav mr-auto'>
            <li class='nav-item active'>
                <a class='nav-link' href='home.php'>Home<span class='sr-only'>(current)</span></a>
            </li>
            <li class='nav-item'>
                <?php if($_SESSION['loggedbool'] == "Login"): ?>
                  <a class='nav-link' href="login.php">Login</a>
                <?php elseif($_SESSION['loggedbool'] == "Account"): ?>
                  <a class='nav-link' href="account.php">My Account</a>
                <?php endif;?>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href="http://localhost:4200/">Contact Us</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='about.php'>About</a>
            </li>
            <?php if($_SESSION['loggedbool'] == "Account"):?>
              <li>
                <a class='nav-link' href="logout.php">Logout</a>
              </li>
            <?php endif;?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <!-- Always remember to call the above files first before calling the bootstrap.min.js file -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>