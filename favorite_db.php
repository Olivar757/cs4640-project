<!-- Add, remove from favorites DB 
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->
<?php 
    // function getMyFavorites($sid){
    //     global $db;
    //     $query = "SELECT * FROM Favorite CROSS JOIN Property WHERE Favorite.listingID = Property.listingID AND Favorite.sid=:sid";
    //     $statement = $db->prepare($query); //make an executable version
    //     $statement->bindValue(':sid', $sid);
    //     $statement->execute();
    //     $results = $statement->fetchAll(); //returns an array of all rows from the result that we execute
    //     $statement->closeCursor();

    //     return $results; 
    // }

    function addToFavorite($user, $rid){
    global $db;

    $query = "CREATE TABLE IF NOT EXISTS `favorites` ( `user` VARCHAR(30) NOT NULL , 'rid' INT NOT NULL )";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
    $query = "INSERT INTO Favorite VALUES(:user, :rid)";
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->bindValue(':rid', $rid);
    $statement->execute();

    $results = $statement->fetchAll(); // returns an array of rows
    $statement->closeCursor();	
    }


    // function removeFavorite($sid, $listingID){
    //     global $db;
    //     $query = "DELETE FROM Favorite WHERE sid=:sid AND listingID=:listingID";
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':sid', $sid);
    //     $statement->bindValue(':listingID', $listingID);
    //     $statement->execute();

    //     $results = $statement->fetchAll(); // returns an array of rows
    //     $statement->closeCursor();	
    // }

    // function checkFavorite($sid, $listingID){
    //     global $db;
    //     $query = "SELECT * FROM Favorite WHERE sid=:sid AND listingID=:listingID";
    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':sid', $sid);
    //     $statement->bindValue(':listingID', $listingID);
    //     $statement->execute();

    //     $results = $statement->fetchAll(); // returns an array of rows
    //     $statement->closeCursor();

    //     return $results;	
    // }
?>