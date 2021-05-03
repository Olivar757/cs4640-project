<!-- Adding a recipe to the page through the user's account
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->

<?php
    require('connectdb.php');
    require('recipe_db.php');
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if($_POST['action'] == "Save details"){
            // echo "saving details";
            $_SESSION['title'] = $_POST['title'];
            $_SESSION['category'] = $_POST['category'];
            $_SESSION['author'] = $_POST['author'];
            $_SESSION['ctime'] = $_POST['ctime'];
            $_SESSION['ptime'] = $_POST['ptime'];
            $_SESSION['ttime'] = $_POST['ttime'];
            $_SESSION['servings'] = $_POST['servings'];
            $saved = true;
            $_SESSION['step'] = "Ingredients count";
        }
        if($_POST['action'] == "Clear details"){
            unset($_SESSION['title']);
            unset($_SESSION['category']);
            unset($_SESSION['ctime']);
            unset($_SESSION['ptime']);
            unset($_SESSION['ttime']);
            unset($_SESSION['servings']);
            unset($_SESSION['i_count']);
            unset($_SESSION['step']);
            unset($_SESSION['step2']);
            unset($_SESSION['measurements']);
            unset($_SESSION['ingredients']);
            unset($_SESSION['step3']);
            unset($_SESSION['s_count']);
            unset($_SESSION['step4']);
            unset($_SESSION['steps']);
            unset($_SESSION['step5']);
        }
        if($_POST['action'] == "Save count"){
            $_SESSION['i_count'] = $_POST['i_count'];
            $_SESSION['step2'] = "Ingredients";
        }
        if($_POST['action'] == "Clear count"){
            unset($_SESSION['i_count']);
            unset($_SESSION['step2']);
            unset($_SESSION['measurements']);
            unset($_SESSION['ingredients']);
            unset($_SESSION['step3']);
            unset($_SESSION['s_count']);
            unset($_SESSION['step4']);
            unset($_SESSION['steps']);
            unset($_SESSION['step5']);
        }
        if($_POST['action'] == "Save ingredients"){
            // echo "Saving ingredients <br>";
            $_SESSION['step3'] = "Steps count";
            $_SESSION['ingredients'] = [];
            $_SESSION['measurements'] = [];
            for($i=0;$i<$_SESSION['i_count'];$i++){
                $ing = $i . "_ingredient";
                $meas = $i . "_measurement";
                array_push($_SESSION['ingredients'], $_POST[$ing]);
                array_push($_SESSION['measurements'], $_POST[$meas]);
            }
            // print_r($_SESSION['ingredients']);
            // print_r($_SESSION['measurements']);
        }
        if($_POST['action'] == "Clear ingredients"){
            unset($_SESSION['measurements']);
            unset($_SESSION['ingredients']);
            unset($_SESSION['step3']);
            unset($_SESSION['s_count']);
            unset($_SESSION['step4']);
            unset($_SESSION['steps']);
            unset($_SESSION['step5']);
        }
        if($_POST['action'] == "Save step count"){
            // echo "save step count <br>";
            $_SESSION['s_count'] = $_POST['s_count'];
            $_SESSION['step4'] = "Steps";
        }
        if($_POST['action'] == "Clear step count"){
            unset($_SESSION['s_count']);
            unset($_SESSION['step4']);
            unset($_SESSION['steps']);
            unset($_SESSION['step5']);
        }
        if($_POST['action'] == "Save steps"){
            $_SESSION['step5'] = "Finalize";
            $_SESSION['steps'] = [];
            for($i=0;$i<$_SESSION['s_count'];$i++){
                $s = $i . "_step";
                array_push($_SESSION['steps'], $_POST[$s]);
            }
        }
        if($_POST['action'] == "Clear steps"){
            unset($_SESSION['steps']);
            unset($_SESSION['step5']);
        }
        if($_POST['action'] == "Save Recipe"){
            // $rid, $title, $author, $ptime, $ctime, $ttime, $servings, $category, $measurements, $ingredients, $steps
            addRecipe("", $_SESSION['title'], $_SESSION['author'], $_SESSION['ptime'], $_SESSION['ctime'], $_SESSION['ttime'], $_SESSION['servings'], $_SESSION['category'], implode(",", $_SESSION['measurements']), implode(",", $_SESSION['ingredients']), implode(",",$_SESSION['steps']));
            unset($_SESSION['title']);
            unset($_SESSION['category']);
            unset($_SESSION['ctime']);
            unset($_SESSION['ptime']);
            unset($_SESSION['ttime']);
            unset($_SESSION['servings']);
            unset($_SESSION['i_count']);
            unset($_SESSION['step']);
            unset($_SESSION['step2']);
            unset($_SESSION['measurements']);
            unset($_SESSION['ingredients']);
            unset($_SESSION['step3']);
            unset($_SESSION['s_count']);
            unset($_SESSION['step4']);
            unset($_SESSION['steps']);
            unset($_SESSION['step5']);
            header("Location:account.php");
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
           <div class="container" style='border-style-bottom:solid;padding-bottom:8.5vh;width:100%;max-width:100%;'>
                <div class="row">
                    <div class="col-sm">
                        Title:
                        <input type="text" maxlength='100' class='form-control' name='title' value="<?php if(isset($_SESSION['title'])) echo $_SESSION['title'];?>" <?php if(isset($_SESSION['title'])) echo "readonly";?> required>
                    </div>
                    <div class="col-sm">
                        Author:
                        <input type="text" class="form-control" name='author' value="<?php echo $_SESSION['user'];?>" readonly>
                    </div>
                    <div class="col-sm">
                        Category:
                        <select name="category" required value='<?php echo $_SESSION['category'];?>' class="custom-select" <?php if(isset($_SESSION['title'])) echo "disabled"?>>
                            <option selected disabled><?php if(isset($_SESSION['category'])) echo $_SESSION['category']; else echo "Choose...";?></option>
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
                        <input type="text" required name='ptime' class="form-control" value='<?php if(isset($_SESSION['ctime'])) echo $_SESSION['ptime'];?>' <?php if(isset($_SESSION['title'])) echo "readonly";?>>
                    </div>
                    <div class="col-sm">
                        Cook Time:
                        <input type="text" required name='ctime' class="form-control" value='<?php if(isset($_SESSION['ptime'])) echo $_SESSION['ctime'];?>' <?php if(isset($_SESSION['title'])) echo "readonly";?>>
                    </div>
                    <div class="col-sm">
                        Total Time:
                        <input type="text" required name='ttime' class="form-control" value='<?php if(isset($_SESSION['ttime'])) echo $_SESSION['ttime'];?>' <?php if(isset($_SESSION['title'])) echo "readonly";?>>
                    </div>
                    <div class="col-sm">
                        Servings:
                        <input type="number" required name='servings' class="form-control" min='0' value='<?php if(isset($_SESSION['servings'])) echo $_SESSION['servings'];?>' <?php if(isset($_SESSION['title'])) echo "readonly";?>>
                    </div>
                </div>
                <?php if(isset($_SESSION['title'])):?>
                    <input type="submit" value="Clear details" name='action' method='post' class='btn btn-primary ml-2' id='sbtn' style='float:right;'>
                <?php endif; ?>
                <input type="submit" value="Save details" name="action" method='post' class='btn btn-primary' id='sbtn' style='float:right;' <?php if(isset($_SESSION['title'])) echo "disabled "?>>
           </div>
        </form>
    </div>
    <?php if(isset($_SESSION['step']) && $_SESSION['step'] == "Ingredients count"): ?>
    <div class="container">
        <h1>How many Ingredients?</h1>
        <form action="add_recipe.php" method='post' class='mb-4'>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <input type="number" required name='i_count' class='form-control' min='1' value='<?php if(isset($_SESSION['i_count'])) echo $_SESSION['i_count']?>' <?php if(isset($_SESSION['i_count'])) echo "readonly"?> style='float:right'>
                    </div>
                </div>
                <?php if(isset($_SESSION['i_count'])):?>
                    <input type="submit" value="Clear count" name='action' method='post' class='btn btn-primary ml-2' id='sbtn' style='float:right;'>
                <?php endif; ?>
                <input type="submit" value='Save count' name='action' method='post' class='btn btn-primary' id='sbtn' <?php if(isset($_SESSION['i_count'])) echo "disabled"?> style='float:right;'>
            </div>
        </form>
    </div>
    <?php endif;?>
    <?php if(isset($_SESSION['step2']) && $_SESSION['step2'] == "Ingredients"): ?>
    <div class="container">
        <h1 style='margin-top:3rem;'>Ingredients</h1>
        <form action="add_recipe.php" method='post'>
        <div class="container">
            <div class="row">
                <div class="col-sm"></div>
                <div class="col-sm">
                    <label>Measurement</label>
                </div>
                <div class="col-sm">
                    <label>Ingredient Name</label>
                </div>
            </div>
                <?php for($i=0;$i<$_SESSION['i_count'];$i++): ?>
                    <div class="row mb-2">
                        <!-- <div class="col-sm"></div> -->
                        <div class="col-sm text-right">
                            Ingredient <?php echo "#" . $i+1;?>
                        </div>
                        <div class="col-sm">
                            <input type="text" required value='<?php if(isset($_SESSION['measurements'])) echo $_SESSION['measurements'][$i]?>'' required name=<?php echo $i . "_measurement"?> class='form-control' <?php if(isset($_SESSION['measurements'])) echo "disabled"?>>
                        </div>
                        <div class="col-sm">
                            <input type="text" required value='<?php if(isset($_SESSION['ingredients'])) echo $_SESSION['ingredients'][$i]?>'' required name=<?php echo $i . "_ingredient"?> class='form-control' <?php if(isset($_SESSION['ingredients'])) echo "disabled"?>>
                        </div>
                    </div>
                <?php endfor;?>
                <?php if(isset($_SESSION['measurements'])):?>
                    <input type="submit" value="Clear ingredients" name='action' method='post' class='btn btn-primary ml-2' id='sbtn' style='float:right;'>
                <?php endif; ?>
                <input type="submit" value='Save ingredients' name='action' method='post' class='btn btn-primary' id='sbtn' style='float:right;' <?php if(isset($_SESSION['measurements'])) echo "disabled"?>>
        </div>
        </form>
    </div>
    <?php endif; ?>
    <?php if(isset($_SESSION['step3']) && $_SESSION['step3'] == "Steps count"): ?>
    <div class="container">
    <h1>How many Steps?</h1>
    <form action="add_recipe.php" method='post' class='mb-4'>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <input type="number" required name='s_count' class='form-control' min='1' value='<?php if(isset($_SESSION['s_count'])) echo $_SESSION['s_count']?>' <?php if(isset($_SESSION['s_count'])) echo "readonly"?> style='float:right'>
                </div>
            </div>
            <?php if(isset($_SESSION['s_count'])):?>
                <input type="submit" value="Clear step count" name='action' method='post' class='btn btn-primary ml-2' id='sbtn' style='float:right;'>
            <?php endif; ?>
            <input type="submit" value='Save step count' name='action' method='post' class='btn btn-primary' id='sbtn' <?php if(isset($_SESSION['s_count'])) echo "disabled"?> style='float:right;'>
        </div>
    </form>
    </div>
    <?php endif; ?>
    <?php if(isset($_SESSION['step4']) && $_SESSION['step4'] == "Steps"): ?>
    <div class="container">
        <h1 style='margin-top:3rem;'>Steps</h1>
        <form action="add_recipe.php" method='post'>
        <div class="container">
            <?php for($i=0;$i<$_SESSION['s_count'];$i++): ?>
                <div class="row mb-2">
                    <div class="col-2 text-right">
                        Step <?php echo "#" . $i+1;?>
                    </div>
                    <div class="col-10">
                        <input type="text" required value='<?php if(isset($_SESSION['steps'])) echo $_SESSION['steps'][$i]?>'' required name=<?php echo $i . "_step"?> class='form-control' <?php if(isset($_SESSION['steps'])) echo "disabled"?>>
                    </div>
                </div>
            <?php endfor;?>
            <?php if(isset($_SESSION['steps'])):?>
                <input type="submit" value="Clear steps" name='action' method='post' class='btn btn-primary ml-2' id='sbtn' style='float:right;'>
            <?php endif; ?>
            <input type="submit" value='Save steps' name='action' method='post' class='btn btn-primary' id='sbtn' style='float:right;' <?php if(isset($_SESSION['steps'])) echo "disabled"?>>
        </div>
        </form>
    </div>
    <?php endif; ?>
    <?php if(isset($_SESSION['step5'])): ?>
        <div class="container" style='margin-top:3rem;text-align:center;'>
            <h1 style='text-align:left;'>Finalize Recipe</h1>
            <form action="add_recipe.php" method='post'>
                <input type="submit" value='Save Recipe' name='action' method='post' class='btn btn-primary text-center' id='sbtn'>
            </form>
        </div>
    <?php endif; ?>
<hr><?php include 'footer.html' ?></body>
</html>