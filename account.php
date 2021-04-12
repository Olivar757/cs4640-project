<!-- Account page 
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->

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
    <meta name='description' content='Personalized account page!'>   
    <title>My Account</title>

</head>
<body>
    <?php include 'navbar.php'?>   

    <div name='body'>
		<div name='welcome-msg'>
			<h1 style='text-align: center'>Welcome back!</em></h1>
		</div>
		<div name='info' style='width: 80%;display:block;margin:auto;border-bottom-style:solid;padding-bottom:5vh;'>
			<img style='border-radius:25px;margin-right:2.5vw;' class='profile_pic' src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSZVLlHlKrUYXoD_kgc2VHr7qRiQppYqYAeNw&usqp=CAU" alt="Your profile photo here!">
			<div class='align-middle' name='basic_info' style='margin:auto;display: inline-block;margin-bottom:10vh;'>
				<h5>Full Name: Name here</h5>
				<h5>Email: Email here</h5>
                <input type="submit" id='sbtn'value="View Recipe" class="btn btn-secondary" onclick="window.location.href='addrecipe.php'"/>			</div>
		</div>
        <div class="container" style='width: 80%;max-width:85%;border-bottom-style:solid;padding-bottom:5vh;'>
            <h2>My Recipes</h2>
        </div>
        <div class="container" style='width: 80%;max-width:85%;border-bottom-style:solid;padding-bottom:5vh;'>
            <h2>My Favorites</h2>
            <div class="container"> <!-- here would be where we access the favorites and display them -->
                <div class="row">
                    <div class="col">fav #1</div>
                    <div class="col">fav #2</div>
                </div>
                <div class="row">
                    <div class="col">fav #3</div>
                    <div class="col">fav #4</div>
                </div>
                <div class="row">
                    <div class="col">fav #5</div>
                    <div class="col">fav #6</div>
                </div>
                <div class="row">
                    <div class="col">fav #7</div>
                    <div class="col">fav #8</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>