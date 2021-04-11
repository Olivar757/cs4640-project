<!-- Log In page for web app 
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
Allows the user to log in to the site -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">   
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Log In</title>
  <meta name="author" content="Dela Rosa, Novkovic">
  <meta name="description" content="log in page">      

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
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class='navbar-nav mr-auto'>
            <li class='nav-item'>
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
            <li class='nav-item active'>
                <a class='nav-link' href='#'>Login</a>
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<!-- Always remember to call the above files first before calling the bootstrap.min.js file -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

  
 <!---Log in form where the user enters their username and password
validation code obtained from validate-form-1.html activity 3/02-->


    <div class='r'>    
        <div class='column'id='form'>
        <h2>Welcome Back!</h2>
        <form method="post" onsubmit="return validateLogIn()">
            <div class ="form-group"> 
                <!--- js autofocus on the username box so there are less clicks for the user-->
                Username:<input type="text" id="username" class="form-control"  autofocus placeholder="Enter Your Username"/>
            </div>
            <div class ="form-group"> 
                Password:<input type="password" id="password" class="form-control" placeholder="Enter Your Password"/>
            </div>
            
            <input id='sbtn' type="submit" value="Log in" class="btn btn-secondary" />
            <!-- sign up button, will link to a registration page in future implementation-->
            <input id='sbtn' style='width:80px;' name='signup' value="Sign Up" class="btn btn-secondary" onclick="myfunction()"/>
            <script>
                function myfunction(){
                    location.href="signup.php";
                }
            </script>
        </form>
        
        </div>

<!-- script that validates the log in information
validation code obtained from validate-form-1.html activity 3/02-->
<script> 
function validateLogIn() {
    var tempuser = "a"; //temporary user and pwd to showcase barebones validation
    var temppwd = "b";
    var username = document.getElementById("username");
    var password = document.getElementById("password"); //if the length of the password is less than or equal to 0 then there is no password entered 
    console.log(username + " " + password);
    console.log(tempuser + " " + temppwd);
    if(username.value.length <=0 && password.value.length <=0) //if the length of the username is less than or equal to 0 then there is no username entered 
    {
        alert ("Please enter a username and password."); //display alert message that username/password must be entered
        return false;
    }
    else if(username.value.length <= 0){
        alert("Please enter a username.");
        return false;
    }
    else if(password.value.length <= 0){
        alert("Please enter a password.");
        return false;
    }
    else if(username.value != tempuser || password.value != temppwd){ //in the final product, these statements will instead evaluate username and pwd combos in a database
        alert("The username or password you've entered is incorrect.");
        return false;
    }
    else if(username.value == tempuser && password.value == temppwd){
        window.location.href = "recipe.php";//this will be replaced by the appropriate page (i.e. my account or something)
        return false;
    }
}

</script>

<!--- php server side validation WIP ---> 

<?php
    require('connectdb.php');
    require('account_db.php');
    session_start();

    $username = "";
    $password = "";
    $mainpage = "signup.php"; 

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($_POST['submit'])) {
            
            if($_POST['submit'] == 'username'){
                if(validate_student_password($username, $password) == 1){
                    $_SESSION["user"]=$username;
                    header("Location:recipes.php");
                   // echo "<span class='msg'>Username and password match our record</span> <br/>";
                }
            }   
        } 
}  

?>





        <!-- Cooking photo with diagonal split for aesthetic component -->
        <div class='column'>
            <img id='cooking' src='https://iconiclife.com/wp-content/uploads/2020/03/take-a-class-from-a-virtual-cooking-school.jpg'>
        </div>
  </div>

    
</body>
</html>