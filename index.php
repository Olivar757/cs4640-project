<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
   case '/':                   // URL (without file name) to a default screen
      require 'home.php';
      break; 
   case '/account.php':
      require 'account.php';
      break;
    case '/home.php':
      require 'home.php';
      break;
    case '/login.php':
      require 'login.php';
      break;
    case '/logout.php':
      require 'logout.php';
      break;
    case '/signup.php':
      require 'signup.php';
      break;
    case '/add_recipe.php':
      require 'add_recipe.php';
      break;
    case '/recipe.php':
      require 'recipe.php';
      break;
    case '/navbar.php':
      require 'navbar.php';
      break;
    case '/account_db.php':
      require 'account_db.php';
      break;
    // case '/contact.php':
    //   require 'contact.php';
    //   break;
    // case '/contact.php':
    //   require 'contact.php';
    //   break;
    // case '/contact.php':
    //   require 'contact.php';
    //   break;
    // case '/contact.php':
    //   require 'contact.php';
    //   break;
      
   default:
      http_response_code(404);
      exit('Not Found');
}  
?>