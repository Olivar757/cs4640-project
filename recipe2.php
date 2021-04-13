<!--- 
Recipe page, showing top rated recipe 
Authors: Noah Dela Rosa (nd8ef) and Natalie Novkovic (nn4bk)-->

<?php
    require('connectdb.php');
    require('favorite_db.php');
    require('comment_db.php');
    session_start();

    date_default_timezone_set("America/New_York");
    // echo $_POST['rid'];
    if(!empty($_POST['rid'])) $_SESSION['rid'] = $_POST['rid'];
    $rid = $_SESSION['rid'];
    $comments = getComments($rid);
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
            header("Location: recipe2.php");
        }
        if(!empty($_POST['btnPress']) && $_POST['btnPress'] == "Delete Comment"){
            $comment = $_POST['deleteComment'];
            deleteComment($comment, $_SESSION['user']);
            header("Location: recipe2.php"); 
        }
    }
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(!empty($_GET['btnPress']) && $_GET['btnPress'] == 'Comment' && !empty($_GET['comment'])){
            $comment = $_GET['comment'];
            addComment($_SESSION['user'], $rid, $comment);
            header('Location: recipe2.php');
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
<title>Recipe: Tuscan Chicken Skillet</title>
</head>
<body>

    <?php include 'navbar.php' ?>

    <!-- Class for the recipe header with the name of the recipe and the contributer, as well as the photo of the recipe-->
    <div class="recipe header">
        <h1>Tuscan Chicken Skillet <p id='heart' style='color:red;display:inline;'><?php if(!empty($check)) echo "♥";?></p></h1>
        <h3>Recipe Created By: <a href="https://www.foodnetwork.com/recipes/food-network-kitchen/tuscan-chicken-skillet-5421728"> Food Network </a> </h3>
    </div>
    
<!-- Image of the final recipe -->
<div class='details' style='width:92.5%;'>
    <div class='photo'>
        <img id="ex" src="https://food.fnr.sndimg.com/content/dam/images/food/fullset/2018/9/26/0/FNK_Tuscan-Chicken-Skillet_H2_s4x3.jpg.rend.hgtvcom.826.620.suffix/1537973085542.jpeg" alt="Tuscan Chicken Skillet">
    </div>
    <!-- Class for the recipe information-->
    <div class="recipe info"> 
        <h4> Category: Meat Lovers</h4>
        <h4> Estimated Cook Time: 30 minutes </h4>
        <h4> Estimated Prep Time: 10 minutes </h4>
        <h4> Estimated Total Time: 40 minutes </h4>
        <h4> Servings: 4 </h4>
        <h4> Change portion</h4>
        <div class="portionbuttons">
            <input class='btn' type="button" value="0.5" id="portionhalf">
            <input class='btn' type="button" value="1" id="portion1">
            <input class='btn' type="button" value="2" id="portion2">
            <input class='btn' type="button" value="3" id="portion3">
        </div>
        
    </div>
</div>

    <!-- Class for the recipe page functions, such as favorite and print/download-->
    <div class="recipe functions"> 
        <form name="mainForm" onclick="favorite()"; method="post" style='display:inline-block;'>
            <input type="hidden" name='favoritedRecipe' value="<?php echo $rid ?>" />
            <?php if(empty($check)):?>
                <input id='sbtn' type="submit" value="Favorite" name="btnPress" class='btn btn-primary'/>
            <?php else: ?>
                <input id='sbtn' type="submit" value="Unfavorite" name="btnPress" class='btn btn-primary'/>
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
        12 ounces fettuccine  <br>
        4 slices bacon, chopped <br>
        1 pound chicken tenders, cut into 1-inch pieces <br>
        2 cloves garlic, minced <br>
        4 plum tomatoes, chopped <br>
        1 cup heavy cream <br>
        5 ounces baby spinach <br>
        3/4 cup grated Parmesan <br>
        3 tablespoons chopped fresh basil <br>
        </p>
    </div>

    <!-- Functions to allow users to change the amount of the recipe they want. Updates ingredients as well. -->
    <script>
        document.getElementById('portionhalf').addEventListener("click", portionfunchalf);
        document.getElementById('portion1').addEventListener("click", portionfuncone);
        document.getElementById('portion2').addEventListener("click", portionfunctwo);
        document.getElementById('portion3').addEventListener("click", portionfuncthree);
        var fettucine = 12.0;
        var bacon = 4.0;
        var garlic = 2.0;
        var chx_tenders = 1.0;
        var hvy_cream = 1.0;
        var bspinach = 5.0;
        var tomatoes = 4;
        var parmesan = 3/4;
        var basil = 3;
        function portionfunchalf() {//couldn't figure out how to add an event listener to multiple buttons and pass it args based on what button was pressed. Ended up just copying the function four times to get it to work. Considering improving this in the future
            // console.log("running portion...");
            // console.log(serving);
            var serving = 0.5;
            var tempfettucine = fettucine * serving;
            var tempbacon = bacon * serving;
            var tempgarlic = garlic * serving;
            var tempchx_tenders = chx_tenders * serving;
            var temphvy_cream = hvy_cream * serving;
            var tempbspinach = bspinach * serving;
            var temptomatoes = tomatoes * serving;
            var tempparmesan = parmesan * serving;
            var tempbasil = basil * serving;
            document.getElementById("ingredients").innerHTML = '<h3> Ingredients: </h3><p>' + tempfettucine + " ounces fettucine <br/>" + tempbacon + " slices bacon, chopped  <br/>" + tempgarlic + " garlic cloves, minced <br/>" + tempchx_tenders + " pound chicken tenders <br/>" + temphvy_cream + " cup heavy cream <br/>" + tempbspinach + " ounces baby spinach <br/>" + temptomatoes + " plum tomatoes,chopped <br/>" + tempparmesan + " cup parmesan, grated  <br/>" + "Salt and pepper, to taste  <br/>" + tempbasil + " tablespoons fresh basil, chopped  <br/>" + "</p>";
    }
    function portionfuncone(){
        // console.log("running portion...");
        // console.log(serving);
        var serving = 1;
        var tempfettucine = fettucine * serving;
        var tempbacon = bacon * serving;
        var tempgarlic = garlic * serving;
        var tempchx_tenders = chx_tenders * serving;
        var temphvy_cream = hvy_cream * serving;
        var tempbspinach = bspinach * serving;
        var temptomatoes = tomatoes * serving;
        var tempparmesan = parmesan * serving;
        var tempbasil = basil * serving;
        document.getElementById("ingredients").innerHTML = '<h3> Ingredients: </h3><p>' + tempfettucine + " ounces fettucine <br/>" + tempbacon + " slices bacon, chopped  <br/>" + tempgarlic + " garlic cloves, minced <br/>" + tempchx_tenders + " pound chicken tenders <br/>" + temphvy_cream + " cup heavy cream <br/>" + tempbspinach + " ounces baby spinach <br/>" + temptomatoes + " plum tomatoes,chopped <br/>" + tempparmesan + " cup parmesan, grated  <br/>" + "Salt and pepper, to taste  <br/>" + tempbasil + " tablespoons fresh basil, chopped  <br/>" + "</p>";
    }
    function portionfunctwo(){
        // console.log("running portion...");
        // console.log(serving);
        var serving = 2;
        var tempfettucine = fettucine * serving;
        var tempbacon = bacon * serving;
        var tempgarlic = garlic * serving;
        var tempchx_tenders = chx_tenders * serving;
        var temphvy_cream = hvy_cream * serving;
        var tempbspinach = bspinach * serving;
        var temptomatoes = tomatoes * serving;
        var tempparmesan = parmesan * serving;
        var tempbasil = basil * serving;
        document.getElementById("ingredients").innerHTML = '<h3> Ingredients: </h3><p>' + tempfettucine + " ounces fettucine <br/>" + tempbacon + " slices bacon, chopped  <br/>" + tempgarlic + " garlic cloves, minced <br/>" + tempchx_tenders + " pound chicken tenders <br/>" + temphvy_cream + " cup heavy cream <br/>" + tempbspinach + " ounces baby spinach <br/>" + temptomatoes + " plum tomatoes,chopped <br/>" + tempparmesan + " cup parmesan, grated  <br/>" + "Salt and pepper, to taste  <br/>" + tempbasil + " tablespoons fresh basil, chopped  <br/>" + "</p>";
    }
    function portionfuncthree(){
        // console.log("running portion...");
        // console.log(serving);
        var serving = 3;
        var tempfettucine = fettucine * serving;
        var tempbacon = bacon * serving;
        var tempgarlic = garlic * serving;
        var tempchx_tenders = chx_tenders * serving;
        var temphvy_cream = hvy_cream * serving;
        var tempbspinach = bspinach * serving;
        var temptomatoes = tomatoes * serving;
        var tempparmesan = parmesan * serving;
        var tempbasil = basil * serving;
        document.getElementById("ingredients").innerHTML = '<h3> Ingredients: </h3><p>' + tempfettucine + " ounces fettucine <br/>" + tempbacon + " slices bacon, chopped  <br/>" + tempgarlic + " garlic cloves, minced <br/>" + tempchx_tenders + " pound chicken tenders <br/>" + temphvy_cream + " cup heavy cream <br/>" + tempbspinach + " ounces baby spinach <br/>" + temptomatoes + " plum tomatoes,chopped <br/>" + tempparmesan + " cup parmesan, grated  <br/>" + "Salt and pepper, to taste  <br/>" + tempbasil + " tablespoons fresh basil, chopped  <br/>" + "</p>";
    }
    </script>

      <!-- Class for the recipe instructions-->
    <div class="recipe instructions "> 
        <h3> Instructions: </h3>
        <p>
            1. Bring a large pot of salted water to a boil. Cook the fettuccine according to package directions; drain.<br/>
            2. Meanwhile, put the bacon in a large, cold skillet, then cook over medium-high heat, stirring occasionally, until crispy, about 8 minutes; transfer to a plate with a slotted spoon. <br/>
            3. Sprinkle the chicken lightly with salt and pepper and add to the skillet in a single layer. Let cook, undisturbed, until golden brown on the underside, 2 to 3 minutes. Continue to cook, stirring occasionally, until cooked through, about 4 minutes more. Transfer to the plate with the bacon.<br/>
            4. Reduce the heat to medium and add the garlic, stirring, until fragrant, about 30 seconds. Add the tomatoes and cream and bring to a simmer, then add the spinach and stir until just wilted. Add the bacon, chicken, fettuccine and Parmesan and toss with tongs until well coated; season to taste with salt and pepper. Sprinkle with basil and serve.<br/>
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
            <!-- <form action="recipe2.php" method='post'>
                <input type="hidden" name='addComment' value='<?php echo $rid?>'>
                <input id='sbtn' type="submit" value="Comment" name="btnPress" class='btn btn-primary'/>
            </form> -->
            <form method='post'>
                <input type="hidden" name="addComment" value="<?php echo $rid ?>" />
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
                    <form action='recipe2.php' method='post'>
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