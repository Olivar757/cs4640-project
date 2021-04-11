<!-- Add, remove from favorites DB 
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->
<?php 

function addToFavorite($username, $recipeID)
{

  global $db;
  $query = "INSERT INTO Favorite VALUES(:username, :recipeID)";
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->bindValue(':recipeID', $recipeID);
  $statement->execute();

  $results = $statement->fetchAll(); // returns an array of rows
  $statement->closeCursor();
	
}


function removeFavorite($username, $recipeID)
{

  global $db;
  $query = "DELETE FROM Favorite WHERE username=:username AND recipeID=:recipeID";
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->bindValue(':recipeID', $recipeID);
  $statement->execute();

  $results = $statement->fetchAll(); // returns an array of rows
  $statement->closeCursor();
  
	
}

function checkFavorite($username, $recipeID)
{

  global $db;
  $query = "SELECT * FROM Favorite WHERE username=:username AND recipeID=:recipeID";
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->bindValue(':recipeID', $recipeID);
  $statement->execute();

  $results = $statement->fetchAll(); // returns an array of rows
  $statement->closeCursor();
   
  return $results;
  
	
}





?>