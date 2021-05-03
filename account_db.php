<!-- Account database queries, addAccount, addAccountInfo, validate_login, getMyInfo
Authors: Natalie Novkovic (nn4bk) and Noah Dela Rosa (nd8ef) 
 -->
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
  
    $query = "CREATE TABLE IF NOT EXISTS `account_info` ( `user` VARCHAR(15) NOT NULL , `email` VARCHAR(30) NOT NULL , `fname` VARCHAR(30) NOT NULL , `lname` VARCHAR(30) NOT NULL )";
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

  function validate_login($username, $password){
    global $db;

    $query = "SELECT accounts.passwrd FROM accounts WHERE accounts.user =:username";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute(); // run query
    $results = $statement->fetchAll();
    $statement->closeCursor(); //release hold on this connection
    
    if(sizeof($results) > 0 ){
      $hash = htmlspecialchars($password); 
      $hash = crypt($hash, "web4640");
      if(strcmp($hash, crypt($password, $hash)) === 0){
        return 1;
      }
    }
    else{
      return 0;
    }
  }

  function getMyInfo($username){
    global $db;

    $query = "SELECT * FROM account_info WHERE account_info.user =:username";
    $statement = $db->prepare($query);
    $statement->bindvalue(':username', $username);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    return $results;
  }

  function getMyRecipes($user){
    global $db;

    $query = "SELECT * FROM recipe WHERE author=:user";
    $statement = $db->prepare($query);
    
    $statement->bindvalue(':user', $user);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    return $results;
}

function removeRecipe($rid, $user){
  global $db;
  $query = "DELETE FROM recipe WHERE rid=:rid and author=:user";
  $statement = $db->prepare($query);
  $statement->bindValue(':rid', $rid);
  $statement->bindValue(':user', $user);
  $statement->execute();
  $statement->closeCursor();	
}

function getRecipe($rid){
  global $db; 

  $query = "SELECT * FROM recipe WHERE rid=:rid";
  $statement = $db->prepare($query);
  $statement->bindValue(':rid', $rid);
  $statement->execute();
  $results = $statement->fetchAll();
  $statement->closeCursor();
  return $results;
}
?>