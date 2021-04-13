<!-- Adding a recipe to the page through the user's account
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->

<?php
    require('connectdb.php');
    require('recipe_db.php');
    session_start();

    if(isset($_SESSIOn['title'])) {
        $title = $_SESSION['title'];
        $category = $_SESSION['category'];
        $author = $_SESSION['author'];
        $ctime = $_SESSION['ctime'];
        $ptime =$_SESSION['ptime'];
        $ttime = $_SESSION['ttime'];
        $servings = $_SESSION['servings'];
    }
    else{
        $title = ""; 
        $category = "";
        $author = "";
        $ctime = "";
        $ptime = "";
        $ttime = "";
        $servings = "";
    }
    if(isset($_SESSION['ingredients'])){
        $ingredients = $_SESSION['ingredients'];
    }
    else{
        $ingredients = [];
    }
    if(isset($_SESSION['steps'])){
        $steps = $_SESSION['steps'];
    }
    else{
        $steps = [];
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if($_POST['action'] == "Save details"){
            $title = $_POST['title'];
            $category = $_POST['category'];
            $author = $_POST['author'];
            $ctime = $_POST['ctime'];
            $ptime =$_POST['ptime'];
            $ttime = $_POST['ttime'];
            $servings = $_POST['servings'];
            $saved = true;
        }
        if($_POST['action'] == "Add ingredient"){
            $measurement = $_POST['measurement'];
            $unit = $_POST['unit'];
            $ingredientName = $_POST['ingredientName'];
            $prep = $_POST['prep'];
            $ingredientInfo = array(
                "measurement" => $measurement,
                "unit" => $unit,
                "ingredientName" => $ingredientName,
                "prep" => $prep
            );
            if(isset($_SESSION['ingredients'])){
                array_push($_SESSION['ingredients'], $ingredientInfo);
                echo "pushed to array";
            }
            else{
                $_SESSION['ingredients'] = array();
                array_push($_SESSION['ingredients'], $ingredientInfo);
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
    <meta name='description' content='Upload your own recipe here!'>
    <title>Add Recipe</title>

</head>
<body>
    <?php include 'navbar.php'?>

    <div class='container'>
        <h1>Recipe details</h1>
        <form action="add_recipe.php" method='post'>
           <div class="container" style='border-bottom-style:solid;padding-bottom:8.5vh;width:100%;max-width:100%;'>
                <div class="row">
                    <div class="col-sm">
                        Title:
                        <input type="text" class='form-control' name='title' value="<?php echo $title;?>" <?php if(isset($saved)) echo "readonly";?>>
                    </div>
                    <div class="col-sm">
                        Author:
                        <input type="text" class="form-control" name='author' value="<?php echo $_SESSION['user'];?>" readonly>
                    </div>
                    <div class="col-sm">
                        Category:
                        <select name="category" class="custom-select" <?php if(isset($_POST['category'])) echo "disabled"?>>
                            <option selected disabled selected><?php if(isset($_POST['category'])) echo $_POST['category']; else echo "Choose...";?></option>
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
                        <input type="text" name='ptime' class="form-control" value='<?php echo $ptime;?>' <?php if(isset($saved)) echo "readonly";?>>
                    </div>
                    <div class="col-sm">
                        Cook Time:
                        <input type="text" name='ctime' class="form-control" value='<?php echo $ctime;?>' <?php if(isset($saved)) echo "readonly";?>>
                    </div>
                    <div class="col-sm">
                        Total Time:
                        <input type="text" name='ttime' class="form-control" value='<?php echo $ttime;?>' <?php if(isset($saved)) echo "readonly";?>>
                    </div>
                    <div class="col-sm">
                        Servings:
                        <input type="number" name='servings' class="form-control" min='0' value='<?php echo $servings;?>' <?php if(isset($saved)) echo "readonly";?>>
                    </div>
                </div>
                <input type="submit" value="Save details" name="action" method='post' class='btn btn-primary' id='sbtn' style='float:right;'>
           </div>
           <h1>Ingredients</h1>
           <div class="container" style='margin-top:2.5vh;width:100%;max-width:100%;'>
                <div class="row">
                    <div class="col">
                        Measurement:
                        <input type="float" class="form-control" name='measurement'>
                    </div>
                    <div class="col">
                        Unit:
                        <input type="text" class="form-control" name='unit'>
                    </div>
                    <div class="col">
                        Ingredient name:
                        <input type="text" class="form-control" name='ingredientName'>
                    </div>
                    <div class="col">
                        Preparation:
                        <input type="text" class="form-control" name='prep'>
                    </div>
                </div>
                <input type="submit" value="Add ingredient" name="action" method='post' class='btn btn-primary' id='sbtn' style='float:right;'>
           </div>
        </form>
    </div>
</body>
</html>