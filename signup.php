<!--- 
Signup Page 
Authors: Noah Dela Rosa (nd8ef) and Natalie Novkovic (nn4bk)-->

<?php
    require('connectdb.php');
    require('account_db.php');

    $username = 'bb';
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
            addAccountInfo($username, $fname, $lname, $email);
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
                    <a class='nav-link' href='home.html'>Home<span class='sr-only'>(current)</span></a>
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
                    <a class='nav-link' href='login.html'>Login</a>
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
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" method='post'>
            <div class="form-row">
                <div class="col">
                    Username:<input type="text" name="username" class="form-control"  autofocus placeholder="Enter Your Username" required/>
                </div>
                <div class="col">
                    Password:<input type="password" name="password" class="form-control" placeholder="Enter Your Password" required/>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    First Name: <input type="text" name="fname" class='form-control' placeholder="Enter Your First Name" required>
                </div>
                <div class="col">
                    Last Name: <input type="text" name="lname" class='form-control' placeholder="Enter Your Last Name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    Email: <input type="email" name="email" class='form-control' placeholder="Enter Your Email" required>
                </div>
            </div>
            <input id='sbtn' name="submit" type="submit" value="Sign Up" class="btn btn-secondary" />
        </form>
        </div>
        <div class='column'>
            <img id='cooking' src='https://iconiclife.com/wp-content/uploads/2020/03/take-a-class-from-a-virtual-cooking-school.jpg'>
        </div>
    </div>

    <script> 
        function validateSignUp() {
            u = username.value.length <= 0;
            p = password.value.length <= 0;
            f = fname.value.length <= 0;
            l = lname.value.length <= 0;
            e = email.value.length <= 0;
            if(u || p || f || l || e) //if the length of the username is less than or equal to 0 then there is no username entered 
            {
                alert ("Please fill the missing field(s)."); //display alert message that username/password must be entered
                return false;
            }
            else if(username.value != tempuser || password.value != temppwd){ //in the final product, these statements will instead evaluate username and pwd combos in a database
                alert("The username or password you've entered is incorrect.");
                
            }
            else if(username.value == tempuser && password.value == temppwd){
                window.location.href = "recipe.html";//this will be replaced by the appropriate page (i.e. my account or something)
                return false;
            }
        }
        
        </script>

</body>