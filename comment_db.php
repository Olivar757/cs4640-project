<?php
    function addComment($user, $rid, $content){
        global $db;

        $query = "CREATE TABLE IF NOT EXISTS comments ( user VARCHAR(30) NOT NULL , rid INT(11) NOT NULL, content VARCHAR(500) NOT NULL )";
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
        $query = "INSERT INTO comments VALUES(:user, :rid, :content)";
        $statement = $db->prepare($query);
        $statement->bindValue(':user', $user);
        $statement->bindValue(':rid', $rid);
        $statement->bindValue(':content', $content);
        $statement->execute(); // run query
        $statement->closeCursor(); //release hold on this connection
      }
      
    function getComments($rid){
        global $db;

        $query = "SELECT * FROM comments WHERE rid=:rid";
        $statement = $db->prepare($query);
        $statement->bindValue(':rid', $rid);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();

        return $results;
    }

    function deleteComment($comment, $user){
        global $db;

        $query = "DELETE FROM comments WHERE content=:comment AND user=:user";
        $statement = $db->prepare($query);
        $statement->bindValue(':comment', $comment);
        $statement->bindValue(':user', $user);
        $statement->execute();
        $statement->closeCursor();

    }
?>