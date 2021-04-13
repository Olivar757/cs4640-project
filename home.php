<!--- 
Home Page, first page the user sees when opening the website
Authors: Noah Dela Rosa (nd8ef) and Natalie Novkovic (nn4bk)-->

<?php 
  require('connectdb.php');
  session_start();
  if(isset($_SESSION['ingredients'])) unset($_SESSION['ingredients']);
  if(isset($_SESSION['steps'])) unset($_SESSION['steps']);
  if(!isset($_SESSION['loggedbool'])) $_SESSION['loggedbool'] = "Login";
  if(isset($_SESSION['user'])){
   // echo $_SESSION['user'] . "<br>";
    $_SESSION['loggedbool'] = "Account";
  }
  //echo $_SESSION['loggedbool'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Dela Rosa, Novkovic">
<meta name="description" content="Landing page for our recipe db">      
<title>Home: SimpleEats</title>

</head>
<body>

  <?php include 'navbar.php' ?>
    <!-- Code we created for the jumbotron which features our top rated recipe on the website 
    -->
    <div class="jtron">
        <div class="jtron-image">
          <img id="ex" src="https://i2.wp.com/www.downshiftology.com/wp-content/uploads/2018/12/Shakshuka-19-500x500.jpg" alt="Shakshuka"> <!--https://downshiftology.com/recipes/shakshuka/-->
          <h4>Shakshuka</h4> <!--- Recipe Acquired From: https://www.bbcgoodfood.com/recipes/chorizo-mozzarella-gnocchi-bake-->
        </div>
        <div class="jtron-text">
          <h1>Top-Rated Recipe</h1>
          <p>This tasty, yet simple top-Rated recipe features delicious ingredients, creating the perfect dish for the whole family.</p>
          <form action="recipe.php" method='post'>
            <input type="hidden" name='rid' value="<?php echo 1?>">
            <input style='margin-left:7.5vw;' type="submit" value="View Recipe" class="btn" method='post'/>
          </form>
        </div>
      </div>

      <!-- Trending now section: place for people to find trending recipies people are loving currently, easy access to the user since it's the first thing they see -->
      <div class="trending">
        <h1>Trending Now!</h1>
        
        <div id='popular'> <!-- Carousel for trending recipes-->
          <div class='carousel-recipe'>
            <h2>Tuscan Chicken Skillet</h2>
            <img id='#recipe-1' src='https://food.fnr.sndimg.com/content/dam/images/food/fullset/2018/9/26/0/FNK_Tuscan-Chicken-Skillet_H2_s4x3.jpg.rend.hgtvcom.826.620.suffix/1537973085542.jpeg'>
            <form action="recipe2.php" method='post'>
              <input type="hidden" name='rid' value="<?php echo 2;?>">
              <input type="submit" value="View Recipe" class="btn" method='post'/> 
            </form>
          </div>
          <div class='carousel-recipe'>
            <h2>Blueberry Coffee Cake Muffins</h2>
            <img id='#recipe-2' src='https://food.fnr.sndimg.com/content/dam/images/food/fullset/2006/9/12/0/ig0706_muffins.jpg.rend.hgtvcom.966.725.suffix/1449692683261.jpeg'>
            <input type="submit" value="View Recipe" class="btn" /> 
          </div>
          <div class='carousel-recipe'>
            <h2>Oven-baked Salmon</h2>
            <img id='#recipe-3' src='https://food.fnr.sndimg.com/content/dam/images/food/fullset/2011/7/26/1/CN1B01_oven-baked-salmon_s4x3.jpg.rend.hgtvcom.966.725.suffix/1382545141944.jpeg'>
            <input type="submit" value="View Recipe" class="btn" /> 
          </div>
          <div class='carousel-recipe'>
            <h2>Key Lime Pie</h2>
            <img id='#recipe-4' src="https://food.fnr.sndimg.com/content/dam/images/food/fullset/2019/9/3/0/FNK_the-best-key-lime-pie_H_s4x3.jpg.rend.hgtvcom.826.620.suffix/1567536810218.jpeg">
            <input type="submit" value="View Recipe" class="btn" /> 
          </div>
          <div class='carousel-recipe'>
            <h2>Korean Fried Chicken</h2>
            <img id='#recipe-5' src="https://food.fnr.sndimg.com/content/dam/images/food/fullset/2020/12/21/0/FN_Korean-Fried-Chicken-H1_s4x3.jpg.rend.hgtvcom.826.620.suffix/1608578883590.jpeg">
            <input type="submit" value="View Recipe" class="btn" /> 
          </div>
        </div>
      </div>
    

</body>