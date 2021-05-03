<!-- Add, update, delete recipe DB 
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->

 <?php

    function addRecipe($rid, $title, $author, $ptime, $ctime, $ttime, $servings, $category, $measurements, $ingredients, $steps){
        global $db;

        $query = "CREATE TABLE IF NOT EXISTS recipe ( rid int PRIMARY KEY AUTO_INCREMENT, title VARCHAR(50) NOT NULL, author VARCHAR(50) NOT NULL, ptime int NOT NULL, ctime int NOT NULL, ttime int NOT NULL, servings int NOT NULL, category VARCHAR(50) NOT NULL, measurements TEXT(1000) NOT NULL, ingredients TEXT(1000) NOT NULL, steps TEXT(1000) NOT NULL)";
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
        $query = "INSERT INTO recipe VALUES(:rid, :title, :author, :ptime, :ctime, :ttime, :servings, :category, :measurements, :ingredients, :steps)";
        $statement = $db->prepare($query);
        $statement->bindValue(':rid', $rid);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':author', $author);
        $statement->bindValue('ptime', $ptime);
        $statement->bindValue('ctime', $ctime);
        $statement->bindValue('ttime', $ttime);
        $statement->bindValue('servings', $servings);
        $statement->bindValue('category', $category);
        $statement->bindValue('measurements', $measurements);
        $statement->bindValue('ingredients', $ingredients);
        $statement->bindValue('steps', $steps);
        $statement->execute(); // run query
        $statement->closeCursor(); //release hold on this connection
    }

?>