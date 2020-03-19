<?php
namespace components;
use controllers\Controller;

class Router{

   private $routers;

   function __construct(){
      $routersPath = APP.'/config/router-config.php';
      $this->routers = include($routersPath);
   }

   /**
   * Возвращает URI
   * @return string
   */

   private function getURI(){
      if(!empty($_SERVER['REQUEST_URI'])){
         $uri = trim($_SERVER['REQUEST_URI'], '/');
      }
      return $uri;
   }

   /**
   * Возвращает имя контроллера
   * @return string
   */

   private function getControllerName($segments){
      $controllerName = array_shift($segments).'Controller';
      return [ucfirst($controllerName), $segments];
   }

   /**
   * Возвращает имя экшена
   * @return string
   */

   private function getActionName($segments){
      return ['action'.ucfirst(array_shift($segments)), $segments];
   }

   public function run(){
      $controller = new Controller();
      if(!empty($uri = $this->getURI())){
         foreach($this->routers as $uriPattern => $path){
            if(preg_match("~$uriPattern~", $uri)){
               $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

               $segments = explode('/', $internalRoute);

               list($controllerName, $segments) = $this->getControllerName($segments);
               list($actionName, $segments) = $this->getActionName($segments);
               
               $result = $controller->runAction($controllerName, $actionName, $segments);

               if($result != null){
                  break;
               }
            }
         }
      }else{
         $resault = $controller->runAction('SiteController', 'actionIndex');
      }
   }
}
