<!-- Account page 
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->

<?php
    require('connectdb.php');
    require('account_db.php');
    require('favorite_db.php');
    session_start();
    $info = getMyInfo($_SESSION['user']);
    $favorites = getMyFavorites($_SESSION['user']);
    // echo "<pre>" , var_dump($favorites) , "</pre>";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(!empty($_POST['btnPress']) && $_POST['btnPress'] == "Remove Favorite"){
            removeFavorite($_POST['delFavorite'], $_SESSION['user']);
            header("Location: account.php");
        }
    }
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
                    <form  style='display:inline-block;' action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <input id='sbtn red' type="submit" value="Delete" name="btnPress" class="btn btn-danger" title="Permanently delete the record" style='margin-top:2vh;'/>
                        <input type="hidden" name="delRecipe" value="php echo recipe id here" />
                    </form>
                </div>
            </div>
        </div>
        <?php if(!empty($favorites)): ?>
            <div class="container" style='width: 80%;max-width:85%;border-bottom-style:solid;padding-bottom:5vh;'>
                <h2>My Favorites</h2>
                <div class="container"> <!-- here would be where we access the favorites and display them -->
                    <?php foreach ($favorites as $f):?>
                        <div class="container" style='padding: 10px;border: solid 1px;margin: 10px 0px 10px 0px;'> <!-- this is where the for loop for the favorites would be -->
                            <div class="row">
                                <div class="col" style='margin:auto;'>
                                    Recipe: <?php echo $f['title']?> 
                                </div>
                                <div class="col" style='margin:auto;'>
                                    Category: <?php echo $f['category']?>
                                </div>
                                <div class="col">
                                    <form name="mainForm" action="recipe.php" method="post" style='margin-top:2vh;display:inline-block;'>
                                        <input type="hidden" name='rid' value="<?php echo $f['rid'] ?>" />
                                        <input id='sbtn' type="submit" value="View Recipe" name="btnPress" class='btn btn-primary'/>
                                    </form>
                                    <form style='margin-top:2vh;display:inline-block;' method="post">
                                        <input id='sbtn red' type="submit" value="Remove Favorite" name="btnPress" class="btn btn-danger" title="Permanently delete the record" style='margin-top:2vh;'/>
                                        <input type="hidden" name="delFavorite" value="<?php echo $f['rid']?>" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        <?php endif;?>
        </div>
</body>
</html>