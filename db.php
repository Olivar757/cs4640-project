<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');  
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

$username = 'web4640';
$password = 'web4640';
$host = 'localhost';
$dbname = 'proj';

$dsn = "mysql:host=$host;dbname=$dbname";
$db = "";

/** connect to the database **/
try 
{
   $db = new PDO($dsn, $username, $password);   
//   echo "<p>You are connected to the database</p>";
}
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{
   // Call a method from any object, 
   // use the object's name followed by -> and then method's name
   // All exception objects provide a getMessage() method that returns the error message 
   $error_message = $e->getMessage();        
   echo "<p>An error occurred while connecting to the database: $error_message </p>";
}
catch (Exception $e)       // handle any type of exception
{
   $error_message = $e->getMessage();
   echo "<p>Error message: $error_message </p>";
}

//retrieve data from the request
$postdata = file_get_contents("php://input");

//extract json format to PHP array 
$request = json_decode($postdata); 

$data = []; 

foreach ($request as $k => $v)
{ 
    $temp = "$k => $v"; 
    $data[0]['post_'.$k] = $v; 
}

global $db;

$n =  $data[0]['post_name'];
$email = $data[0]['post_email'];
$msg = $data[0]['post_content'];
$reason = $data[0]['post_reason'];
$query = "INSERT INTO messages VALUES(:n, :email, :msg, :reason)";
$statement = $db->prepare($query);
$statement->bindValue(':n', $n);
$statement->bindValue(':email', $email);
$statement->bindValue(':msg', $msg);
$statement->bindValue(':reason', $reason);
$statement->execute(); // run query
$statement->closeCursor(); //release hold on this connection

?>