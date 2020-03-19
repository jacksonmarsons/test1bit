<?php
namespace controllers;
use components\DataBase;

class Controller{
   public $layout = true;

   public function runAction($controllerName, $actionName, $segments = null){
      $controllerFile = APP.'/controllers/' . $controllerName . '.php';

      if(file_exists($controllerFile)){
         include_once($controllerFile);
      }

      $controller = new $controllerName;
      ($segments) ? call_user_func_array(array($controller, $actionName), $segments) : $controller->$actionName();
      
      return true;
   }

}
?>
