<!-- Adding a recipe to the page through the user's account
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->

<?php
    require('connectdb.php');
    require('recipe_db.php');
    session_start();

    $title = "";
    $category = "";
    $author = "";
    $ctime = "";
    $ptime = "";
    $ttime = "";
    $servings = "";
    $ingredients = "";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content = "Dela Rosa, Novkovic">
    <meta name='description' content='Upload your own recipe here!'>
    <title>Add Recipe</title>

</head>
<body>
    <?php include 'navbar.php'?>

    <div class='container'>
        <h1>Add a recipe</h1>
        <form action="add_recipe.php" method='post'>
           <div class="container">
                <div class="row">
                    <div class="col-sm">
                        Title:
                        <input type="text" class='form-control' name='title' value="<?php echo $title;?>">
                    </div>
                    <div class="col-sm">
                        Author:
                        <input type="text" class="form-control" name='author' value="<?php echo $_SESSION['user'];?>" readonly>
                    </div>
                    <div class="col-sm">
                        Category:
                        <select name="category" class="custom-select">
                            <option disabled selected>Choose...</option>
                            <option value="Vegetarian">Vegetarian</option>
                            <option value="Vegan">Vegan</option>
                            <option value="Dairy-free">Dairy-free</option>
                            <option value="Low-budget">Low-budget</option>
                            <option value="Meat Lovers">Meat Lovers</option>
                            <option value="Dessert">Dessert</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        Prep Time:
                        <input type="text" class="form-control" value='<?php echo $ptime;?>'>
                    </div>
                    <div class="col-sm">
                        Cook Time:
                        <input type="text" class="form-control" value='<?php echo $ctime;?>'>
                    </div>
                    <div class="col-sm">
                        Total Time:
                        <input type="text" class="form-control" value='<?php echo $ttime;?>'>
                    </div>
                    <div class="col-sm">
                        Servings:
                        <input type="number" class="form-control" min='0' value='<?php echo $servings;?>'>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Measurement:
                        <input type="float" class="form-control">
                    </div>
                    <div class="col">
                        Unit:
                        <input type="text" class="form-control">
                    </div>
                    <div class="col">
                        Ingredient name:
                        <input type="text" class="form-control">
                    </div>
                    <div class="col">
                        Preparation:
                        <input type="text" class="form-control">
                    </div>
                </div>
           </div>
        </form>
    </div>
</body>
</html>