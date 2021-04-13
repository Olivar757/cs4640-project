<!-- Add, remove from favorites DB 
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->
<?php 
    function getMyFavorites($user){
        global $db;
        $query = "SELECT * FROM recipes cross join favorites where favorites.rid = recipes.rid and favorites.user =:user";
        $statement = $db->prepare($query); //make an executable version
        $statement->bindValue(':user', $user);
        $statement->execute();
        $results = $statement->fetchAll(); //returns an array of all rows from the result that we execute
        $statement->closeCursor();

        return $results; 
    }

    function addToFavorite($user, $rid){
    global $db;

    $query = "CREATE TABLE IF NOT EXISTS favorites ( user VARCHAR(15) NOT NULL , rid INTEGER(11) NOT NULL )";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
    $query = "INSERT INTO favorites VALUES(:user, :rid)";
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->bindValue(':rid', $rid);
    $statement->execute();

    $results = $statement->fetchAll(); // returns an array of rows
    $statement->closeCursor();	
    }


    function removeFavorite($rid, $user){
        global $db;
        $query = "DELETE FROM favorites WHERE rid=:rid and user=:user";
        $statement = $db->prepare($query);
        $statement->bindValue(':rid', $rid);
        $statement->bindValue(':user', $user);
        $statement->execute();

        $results = $statement->fetchAll();
        $statement->closeCursor();	
    }

    function checkFavorite($rid, $user){
    global $db;

    $query = "SELECT * FROM favorites WHERE rid=:rid AND user=:user";
    $statement = $db->prepare($query);
    $statement->bindValue(':rid', $rid);
    $statement->bindValue(':user', $user);
    $statement->execute();

    $results = $statement->fetchAll(); // returns an array of rows
    $statement->closeCursor();
    
    return $results;
    
        
    }

?>