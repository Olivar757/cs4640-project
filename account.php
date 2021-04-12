<!-- Account page 
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->

<?php
    require('connectdb.php');
    require('account_db.php');
    session_start();
    echo $_SESSION['user'] . "<br>";
    $info = getMyInfo($_SESSION['user']);
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
				<h5>Full Name: <?php echo $info[0]['fname'] . " " . $info[0]['lname']?></h5>
				<h5>Email: <?php echo $info[0]['email']?></h5>
                <input type="submit" id='sbtn'value="Add a recipe" class="btn btn-secondary" onclick="window.location.href='add_recipe.php'"/></div>
		</div>
        <div class="container" style='width: 80%;max-width:85%;border-bottom-style:solid;padding-bottom:5vh;'>
            <h2>My Recipes</h2>
        </div>
        <div class="container" style='width: 80%;max-width:85%;border-bottom-style:solid;padding-bottom:5vh;'>
            <h2>My Favorites</h2>
            <div class="container"> <!-- here would be where we access the favorites and display them -->
                <div class="container">
                    <form name="mainForm" action="recipe.php" method="post" style='display:inline-block;'>
                        <!-- <input type="hidden" value="<?php echo $p['listingID'] ?>" /> -->
                        <input id='recBtn' type="submit" value="View Recipe!" name="action" class='btn btn-primary' style='margin-top: 10px;background-color: #84DCC6; border-color: #84DCC6;color:#000;'/>
                    </form>
                    <form action="#" method="post" style='display:inline-block'>
                        <input id='recBtn' type="submit" value="Edit" name="action" class="btn btn-primary" title="Update the record" style='margin-top:10px;margin-right:15px;color:black;background-color:#84DCC6;border-color:#84DCC6;'/>
                        <input type="hidden" name="updateRecipe" value="php echo recipe id here" />
                    </form>
                    <form id='recBtn' style='display:inline-block;' action="php server server self here" method="post">
                        <input type="submit" value="Delete" name="action" class="btn btn-danger" title="Permanently delete the record" style='color:black;margin-top:10px;'/>
                        <input type="hidden" name="delRecipe" value="php echo recipe id here" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>