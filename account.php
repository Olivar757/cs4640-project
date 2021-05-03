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
    $recipes = getMyRecipes($_SESSION['user']);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(!empty($_POST['btnPress']) && $_POST['btnPress'] == "Remove Favorite"){
            removeFavorite($_POST['delFavorite'], $_SESSION['user']);
            header("Location: account.php");
        }
        if(!empty($_POST['btnPress']) && $_POST['btnPress'] == "Remove Recipe"){
            removeRecipe($_POST['delRecipe'], $_SESSION['user']);
            header("Location: account.php");
        }
        if(!empty($_POST['btnPress']) && $_POST['btnPress'] == "View Recipe"){
            if($_POST['rid'] == "1"){
                header("Location: recipe.php");
                $_SESSION['rid'] = 1;
            }
            else{ 
                header("Location: recipe2.php");
                $_SESSION['rid'] = 2;
            }
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
        <?php if(!empty($recipes)):?>
            <div class="container" style='width: 80%;max-width:85%;border-bottom-style:solid;padding-bottom:5vh;'>
                <h2>My Recipes</h2>
                <div class="container"> <!-- here we'd access the user's recipes -->
                    <?php foreach ($recipes as $r): ?>
                    <div class="container" style='padding: 10px;border: solid 1px;margin: 10px 0px 10px 0px;'>
                        <div class="row">
                            <div class="col" style='margin:auto;'>
                                Recipe: <?php echo $r['title']?> 
                            </div>
                            <div class="col" style='margin:auto;'>
                                Category: <?php echo $r['category']?>
                            </div>
                            <div class="col">
                                <form name="mainForm" method="post" action='recipeview.php' style='margin-top:0;display:inline-block;'>
                                    <input type="hidden" name='rid' value="<?php echo $r['rid'] ?>" />
                                    <input id='sbtn' type="submit" value="View Recipe" name="btnPress" style='margin-top:0;' class='btn btn-primary'/>
                                </form>
                                <form style='margin-top:0;display:inline-block;' method="post">
                                    <input id='sbtn red' style='margin-top:0;' type="submit" value="Remove Recipe" name="btnPress" class="btn btn-danger" title="Permanently delete the record" style='margin-top:2vh;'/>
                                    <input type="hidden" name="delRecipe" value="<?php echo $r['rid']?>" />
                                </form>
                            </div>  
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        <?php else:?>
            <div class="container" style='width: 80%;max-width:85%;border-bottom-style:solid;padding-bottom:5vh;'>
                <h2>You have no recipes!</h2>
            </div>
        <?php endif;?>
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
                                    <form name="mainForm" method="post" style='margin-top:0;display:inline-block;'>
                                        <input type="hidden" name='rid' value="<?php echo $f['rid'] ?>" />
                                        <input id='sbtn' type="submit" value="View Recipe" name="btnPress" style='margin-top:0;' class='btn btn-primary'/>
                                    </form>
                                    <form style='margin-top:0;display:inline-block;' method="post">
                                        <input id='sbtn red' style='margin-top:0;' type="submit" value="Remove Favorite" name="btnPress" class="btn btn-danger" title="Permanently delete the record" style='margin-top:2vh;'/>
                                        <input type="hidden" name="delFavorite" value="<?php echo $f['rid']?>" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        <?php else:?>
            <div class="container" style='width: 80%;max-width:85%;border-bottom-style:solid;padding-bottom:5vh;'>
                <h2>You have no favorites!</h2>
            </div>
        <?php endif;?>
        </div>
</body>
</html>