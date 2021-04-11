<!-- Add, remove from favorites DB 
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->
<?php 

function addToFavorite($sid, $listingID)
{

  global $db;
  $query = "INSERT INTO Favorite VALUES(:sid, :listingID)";
  $statement = $db->prepare($query);
  $statement->bindValue(':sid', $sid);
  $statement->bindValue(':listingID', $listingID);
  $statement->execute();

  $results = $statement->fetchAll(); // returns an array of rows
  $statement->closeCursor();
	
}


function removeFavorite($sid, $listingID)
{

  global $db;
  $query = "DELETE FROM Favorite WHERE sid=:sid AND listingID=:listingID";
  $statement = $db->prepare($query);
  $statement->bindValue(':sid', $sid);
  $statement->bindValue(':listingID', $listingID);
  $statement->execute();

  $results = $statement->fetchAll(); // returns an array of rows
  $statement->closeCursor();
  
	
}

function checkFavorite($sid, $listingID)
{

  global $db;
  $query = "SELECT * FROM Favorite WHERE sid=:sid AND listingID=:listingID";
  $statement = $db->prepare($query);
  $statement->bindValue(':sid', $sid);
  $statement->bindValue(':listingID', $listingID);
  $statement->execute();

  $results = $statement->fetchAll(); // returns an array of rows
  $statement->closeCursor();
   
  return $results;
  
	
}





?>