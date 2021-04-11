<?php


function addAccount($username, $passwrd){
  
    global $db;
    $query = "CREATE TABLE IF NOT EXISTS `accounts` ( `user` VARCHAR(15) NOT NULL , `passwrd` VARCHAR(30) NOT NULL )";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
    $query = "INSERT INTO accounts VALUES(:username, :passwrd)";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':passwrd', $passwrd);
    $statement->execute(); // run query
    $statement->closeCursor(); //release hold on this connection
    
  }
  
  function addAccountInfo($username, $fname, $lname, $email){
    
    global $db;
  
    $query = "CREATE TABLE IF NOT EXISTS `account_info` ( `user` VARCHAR(15) NOT NULL , `passwrd` VARCHAR(30) NOT NULL )";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
    $query = "INSERT INTO account_info VALUES(:username, :fname, :lname, :email)";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':fname', $fname);
    $statement->bindValue(':lname', $lname);
    $statement->execute(); // run query
    $statement->closeCursor(); //release hold on this connection
    
  }

?>