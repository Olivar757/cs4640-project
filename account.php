<!-- Account page 
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->

<?php
    require('connectdb.php');
    require('account_db.php');
    session_start();
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
            <div class="container"> <!-- here we'd access the user's recipes -->
                <div class="container">
                    <form action="#" method="post" style='display:inline-block'>
                        <input id='sbtn' type="submit" value="Edit" name="btnPress" class="btn btn-primary recBtn" title="Update the record"/>
                        <input type="hidden" name="updateRecipe" value="php echo recipe id here" />
                    </form>
                    <form  style='display:inline-block;' action="php server server self here" method="post">
                        <input id='sbtn red' type="submit" value="Delete" name="btnPress" class="btn btn-danger" title="Permanently delete the record" style='margin-top:2vh;'/>
                        <input type="hidden" name="delRecipe" value="php echo recipe id here" />
                    </form>
                </div>
            </div>
        </div>
        <div class="container" style='width: 80%;max-width:85%;border-bottom-style:solid;padding-bottom:5vh;'>
            <h2>My Favorites</h2>
            <div class="container"> <!-- here would be where we access the favorites and display them -->
                <div class="container"> <!-- this is where the for loop for the favorites would be -->
                    <form name="mainForm" action="recipe.php" method="post" style='display:inline-block;'>
                        <!-- <input type="hidden" value="<?php echo $p['listingID'] ?>" /> -->
                        <input id='sbtn' type="submit" value="View Recipe" name="btnPress" class='btn btn-primary'/>
                    </form>
                    <form  style='display:inline-block;' action="php server server self here" method="post">
                        <input id='sbtn red' type="submit" value="Remove Favorite" name="btnPress" class="btn btn-danger" title="Permanently delete the record" style='margin-top:2vh;'/>
                        <input type="hidden" name="delFavorite" value="php echo recipe id here" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>