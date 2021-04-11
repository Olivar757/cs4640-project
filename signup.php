<!--- 
Signup Page 
Authors: Noah Dela Rosa (nd8ef) and Natalie Novkovic (nn4bk)-->

<?php
    require('connectdb.php');
    require('account_db.php');

    $username = '';
    $pwd = '';
    $fname = '';
    $lname = '';
    $email = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $username = $_POST['username'];
        $pwd = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];

        $hash = htmlspecialchars($pwd); 
        $hash = crypt($hash, "web4640");

        if(isset($_POST['submit'])){
            addAccount($username, $hash);
            addAccountInfo($username, $email, $fname, $lname);
            header("Location: login.php");
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Dela Rosa, Novkovic">
<meta name="description" content="Landing page for our recipe db">      
<title>Home: SimpleEats</title>

<!--Link to our stylesheet we created-->
<link rel='stylesheet' href="styles.css">

<!-- We used bootstrap for the navigation bar at
   https://getbootstrap.com/docs/4.0/components/navbar/ -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Recipes
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Vegetarian</a>
                      <a class="dropdown-item" href="#">Vegan</a>
                      <a class="dropdown-item" href="#">Dairy-free</a>
                      <a class="dropdown-item" href="#">Low-budget</a>
                      <a class="dropdown-item" href="#">Meat Lovers</a>
                      <a class="dropdown-item" href="#">Dessert</a>
                    </div>
                  </li>
                <li class='nav-item'>
                    <a class='nav-link' href='login.php'>Login</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'>Contact Us</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#'>About</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class='r'>    
        <div class='column'id='form'>
        <h2>Create Your Account!</h2>
        <form method="post" onsubmit="return validateSignUp()">
        <div class="form-row">
                <div class="col">
                    Username:<input type="text" name="username" id="username" class="form-control"  autofocus placeholder="Enter Your Username"/>
                </div>
                <div class="col">
                    Password:<input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password"/>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    First Name: <input type="text" name="fname" id="fname" class='form-control' placeholder="Enter Your First Name">
                </div>
                <div class="col">
                    Last Name: <input type="text" name="lname" id="lname" class='form-control' placeholder="Enter Your Last Name">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    Email: <input type="email" name="email" id="email" class='form-control' placeholder="Enter Your Email">
                </div>
            </div>
            <input id='sbtn' name="submit" type="submit" value="Sign Up" class="btn btn-secondary" />
        </form>
    </div> 
        <div class='column'>
            <img id='cooking' src='https://iconiclife.com/wp-content/uploads/2020/03/take-a-class-from-a-virtual-cooking-school.jpg'>
        </div>
    

    <script> 
        function validateSignUp() {
            var u = document.getElementById("username").value;
            var p = document.getElementById("password").value;
            var f = document.getElementById("fname").value;
            var l = document.getElementById("lname").value;
            var e = document.getElementById("email").value;

            if(u == null || p == null || f == null || l == null || e.length == null) //if the length of the username is less than or equal to 0 then there is no username entered 
            {
                alert ("Please fill the missing field(s)."); //display alert message that username/password must be entered
                return false;
            }

            // Validate password strength
            var password = document.getElementById("password").value;
            var uppercase = /[A-Z]/.test(password);
            var lowercase = /[a-z]/.test(password);
            var number = /[0-9]/.test(password);

            if(!uppercase || !lowercase || !number || password.length < 8) {
                alert("Password should be at least 8 characters in length and should include at least one upper case letter, and one number.");
                return false;
            }

        }
        
        </script>
    </div>
</body>