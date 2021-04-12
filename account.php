<!-- Account page 
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->

<?php

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
    <?php include 'navbar.html'?>   

    <div name='body'>
		<div name='welcome-msg'>
			<h1 style='text-align: center'>Welcome back, <em><?php echo $info[0]['fname'] . " " . $info[0]['lname']?></em></h1>
		</div>
		<div name='info' style='width: 80%;display:block;margin: auto;'>
			<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSZVLlHlKrUYXoD_kgc2VHr7qRiQppYqYAeNw&usqp=CAU" alt="Your profile photo here!" style=''>
			<div class='align-middle' name='basic_info' style='margin:auto;display: inline-block;'>
				<p>Full Name: <?php echo $info[0]['fname'] . " " . $info[0]['lname']?></p>
				<p>Email: <?php echo $info[0]['semail']?></p>
			</div>
		</div>
    </div>
</body>
</html>