<?php
    require('connectdb.php');
    require('favorite_db.php');
    require('comment_db.php');
    require('account_db.php');
    session_start();

    // echo "Session " . $_SESSION['rid'] . "<br>";
    
    if(!empty($_POST['rid']))
        $_SESSION['rid']= $_POST['rid'];
    // $recipe = $_SESSION["rid"];
    $r = getRecipe($_SESSION['rid']);
    // echo print_r($recipe);
    // echo $r[0]['measurements'] . "<br>";
    $measurements = explode(",", $r[0]['measurements']);
    $ingredients = explode(",", $r[0]['ingredients']);
    $steps = explode(",", $r[0]["steps"]);

    date_default_timezone_set("America/New_York");
    // echo $_POST['rid'];
    if(!empty($_POST['rid'])) $_SESSION['rid'] = $_POST['rid'];
    $rid = $_SESSION['rid'];
    $comments = getComments($rid);
    if(isset($_SESSION['user']))
        $check = checkFavorite($rid, $_SESSION['user']);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(!empty($_POST['btnPress']) && $_POST['btnPress'] == "Favorite"){
            addToFavorite($_SESSION['user'], $rid);
            $check = checkFavorite($rid, $_SESSION['user']);
        }
        if(!empty($_POST['btnPress']) && $_POST['btnPress'] == "Unfavorite"){
            removeFavorite($rid, $_SESSION['user']);
            $check = checkFavorite($rid, $_SESSION['user']);
        }
        if(!empty($_POST['btnPress']) && $_POST['btnPress'] == 'Comment'){
            $comment = $_POST['comment'];
            addComment($_SESSION['user'], $rid, $comment);
            header("Location: recipeview.php");
        }
        if(!empty($_POST['btnPress']) && $_POST['btnPress'] == "Delete Comment"){
            $comment = $_POST['deleteComment'];
            deleteComment($comment, $_SESSION['user']);
            header("Location: recipeview.php"); 
        }
    }
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(!empty($_GET['btnPress']) && $_GET['btnPress'] == 'Comment' && !empty($_GET['comment'])){
            $comment = $_GET['comment'];
            addComment($_SESSION['user'], $rid, $comment);
            header('Location: recipeview.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Dela Rosa, Novkovic">
    <meta name="description" content="">      
    <title>Recipe: <?php echo $r[0]['title']?></title>
</head>
<body>
    <?php include 'navbar.php'?>
    <!-- Class for the recipe header with the name of the recipe and the contributer, as well as the photo of the recipe-->
    <div class="recipe header">
        <h1><?php echo $r[0]['title'] ?> <p id='heart' style='color:red;display:inline;'><?php if(!empty($check)) echo "♥";?></p></h1>
        <h3>Recipe Created By: <?php echo $r[0]['author'] ?> </h3>
    </div>
    
<!-- Image of the final recipe -->
<div class='details' style='width:92.5%;'>
    <div class='photo'>
        <img id="ex" src="https://cdn.boldomatic.com/content/post/lxZcDA/insert-food-picture-here?size=800" alt="Shakshuka"><!--https://downshiftology.com/recipes/shakshuka/-->
    </div>
    <!-- Class for the recipe information-->
    <div class="recipe info"> 
        <h4> Category: <?php echo $r[0]['category'] ?></h4>
        <h4> Estimated Cook Time: <?php echo $r[0]['ctime'] ?> minutes </h4>
        <h4> Estimated Prep Time: <?php echo $r[0]['ptime'] ?> minutes </h4>
        <h4> Estimated Total Time: <?php echo $r[0]['ttime'] ?> minutes </h4>
        <h4> Servings: <?php echo $r[0]['servings'] ?> </h4>        
    </div>
</div>

    <!-- Class for the recipe page functions, such as favorite and print/download-->
    <div class="recipe functions"> 
        <form name="mainForm" onclick="favorite()"; method="post" style='display:inline-block;'>
            <input type="hidden" name='favoritedRecipe' value="<?php echo $r[0]['rid'] ?>" />
            <?php if(isset($_SESSION['user'])):?>
                <?php if(empty($check)):?>
                    <input id='sbtn' type="submit" value="Favorite" name="btnPress" class='btn btn-primary'/>
                <?php else: ?>
                    <input id='sbtn' type="submit" value="Unfavorite" name="btnPress" class='btn btn-primary'/>
                <?php endif; ?>
            <?php endif; ?>
            <input id="sbtn" type="submit" value="Print" onclick="print();" class='btn btn-primary' style='max-width:5vw;'>
        </form>

    </div>

    <!-- Functions for favoriting and printing out the recipe -->
    <script>
        function favorite(){
            var x = document.getElementById("heart");
            x.style.display === "none" ? x.style.display = "inline" : x.style.display = "none";
        }
        function prnt(){
            window.print();
        }    
    </script>

    <!-- Class for the recipe ingredients-->
    <div class="recipe ingredients" id="ingredients"> 
        <h3> Ingredients: </h3>
        <p>
        <?php for($i=0;$i<count($ingredients);$i++): ?>
            <?php echo $measurements[$i] . " " . $ingredients[$i] . "<br>" ?>
        <?php endfor;?>
        </p>
    </div>

      <!-- Class for the recipe instructions-->
    <div class="recipe instructions "> 
        <h3> Instructions: </h3>
        <p>
        <?php for($i=0;$i<count($steps);$i++)
            echo $i+1 . ". " . $steps[$i] . ".<br>"
        ?>
        </p>
    </div>

    <!-- Comment section, code acquired from POTD4 with modifications-->
    <div class="comment comment-form"> 
        <h3> Leave a comment!</h3>
        <form>
            <?php if(!isset($_SESSION['user'])): ?>
                <label>First Name: </label>
                <input type="text" name="fname" id='first'/> <br/>
                <label>Last Name:</label>
                <input type="text" name="lname" id='last'/> <br/>
            <?php else: ?>
                <label>Name: </label>
                <input type="text" name="name" id='name' value='<?php echo $_SESSION["user"] ?>' disabled/> <br/>
            <?php endif;?>
            <label>Comment: </label>
            <textarea id='comment' rows="5" cols="40" name="comment"></textarea> <br/>
            <!-- <form action="recipe.php" method='post'>
                <input type="hidden" name='addComment' value='<?php echo $r[0]['rid']?>'>
                <input id='sbtn' type="submit" value="Comment" name="btnPress" class='btn btn-primary'/>
            </form> -->
            <form method='post'>
                <input type="hidden" name="addComment" value="<?php echo $r[0]['rid'] ?>" />
                <input id='sbtn' type="submit" value="Comment" name="btnPress" class='btn btn-primary'/>
              </form>
          </form>
    </div>

    <?php if(!empty($comments)): ?>
    <h3 class='commentSection'>Comments from others:</h3>
    <div class='comments' id='csection'>
        <?php foreach ($comments as $c): ?>
            <div class="comment">
                <h4><?php echo $c[0] . " said:"?></h4>
                <p><?php echo $c[2]?></p>
                <?php if($_SESSION['user'] == $c[0]): ?>
                    <form action='recipe.php' method='post'>
                        <input type="hidden" name='deleteComment' value="<?php echo $c[2]?>" />
                        <input type='submit' class='btn btn-danger' value="Delete Comment" id='sbtn red' name="btnPress"></input>
                    </form>
                <?php endif;?>
                <br>
                <p class='timeposted'><?php echo "Posted at " . date("h:i") . " on " . date('m-d-Y');?></p> <!-- "h:i on m d Y" -->
            </div>
        <?php endforeach;?>
    </div>
    <?php endif;?>
</body>
</html>