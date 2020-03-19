<?php
spl_autoload_register(function($className) {
   $className = APP . DS . str_replace('\\', DS, $className) . '.php';
   if(!file_exists($className)){
      throw new Exception("\nFile path $className not found!");
   }
   require_once($className);
});
?>
