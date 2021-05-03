<?php
    require('connectdb.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content = "Dela Rosa, Novkovic">
    <meta name='description' content='About Us Page'>   
    <title>About Us</title>
</head>
<body>
    <?php include 'navbar.php'?>
    <div class="container">
        <div class="container">
            <h1 style='text-align:center;'>About Us</h1>
            <hr>
            <h3 style='text-align:center;'> Welcome to SimpleEats! Here at 
            SimpleEats, we provide simple solutions for all your food needs and cravings.
            Are you a vegetarian, vegan, or dairy-free? Do you love meat or desserts?
            Are you interested in saving some money with low-budget meals? We've got you covered! 
            Our website showcases a wide variety of recipies posted by people from all over the globe.
            Find your perfect recipe here on SimpleEats!  </h3> 

            <!-- image acquired from https://www.helpguide.org/articles/healthy-eating/high-fiber-foods.htm--> 
            <center><img id="food" src='https://www.helpguide.org/wp-content/uploads/table-with-grains-vegetables-fruit-768.jpg'></center>
        </div>
    </div>
<hr><?php include 'footer.html' ?></body>
</html>