<!--- 
Signup Page 
Authors: Noah Dela Rosa (nd8ef) and Natalie Novkovic (nn4bk)-->

<?php
    require('connectdb.php');
    require('account_db.php');
    session_start();

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

        if($pwd != ""){
            $uppercase = preg_match('@[A-Z]@', $pwd);
            $lowercase = preg_match('@[a-z]@', $pwd);
            $number    = preg_match('@[0-9]@', $pwd);
            if(!preg_match('/[A-Z]/', $pwd)){
                $code = 1;
                $err = "Password should include at least one upper case letter.";
            }
            elseif(!preg_match('/[a-z]/', $pwd)){
                $code = 2;
                $err = "Password should include at least one lower case letter.";
                // echo "need lower";
            }
            elseif(!preg_match('/\d/', $pwd)){
                $code = 3;
                $err = "Password should include one number.";
                echo "need digit";
            }
            elseif(strlen($pwd)<8) $err = "Password must be at least 8 characters long.";
        }
        else $err = "You need to enter a password.";

        $hash = htmlspecialchars($pwd); 
        $hash = crypt($hash, "web4640");

        if(isset($_POST['submit'])){
            if(!isset($err)){
                addAccount($username, $hash);
                addAccountInfo($username, $email, $fname, $lname);
                header("Location: login.php");
            }
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
<title>Sign Up</title>

<!--Link to our stylesheet we created-->
<link rel='stylesheet' href="styles.css">

<!-- We used bootstrap for the navigation bar at
   https://getbootstrap.com/docs/4.0/components/navbar/ -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <?php include 'navbar.php' ?>

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
    <!-- Validate password strength -->
    <?php if(isset($err)){echo "<script>alert('$err')</script>";$err = null; unset($err);}?>
    

    <script> 
        function validateSignUp() {
            var u = document.getElementById("username").value;
            var p = document.getElementById("password").value;
            var f = document.getElementById("fname").value;
            var l = document.getElementById("lname").value;
            var e = document.getElementById("email").value;

            if(u == "" || p == "" || f == "" || l == "" || e == "") //if the length of the username is less than or equal to 0 then there is no username entered 
            {
                alert ("Please fill the missing field(s)."); //display alert message that username/password must be entered
                return false;
            }
        }
        
        </script>
    </div>
</body>

