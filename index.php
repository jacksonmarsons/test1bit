<?php
   ini_set('display_errors', 1);
   error_reporting(E_ALL);
   
   define('APP', dirname(__FILE__));
   define('DS', DIRECTORY_SEPARATOR);

   require_once(APP.'/components/Autoload.php');    
   use components\Router;
   $router = new Router();
   $router->run();
