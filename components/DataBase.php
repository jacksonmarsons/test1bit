<?php
namespace components;

class DataBase{
   static function dbConnect(){
      $path = APP.'/config/main-config.php';
      $params = include($path);

      if($dbParams = $params['app']['db_connect']){
         foreach($dbParams as $param){
            try{
               $db = new \PDO($param['dsn'], $param['user'], $param['password']);
               $db->exec('set names utf-8');
               return $db;
            }
            catch(PDOExection $e){
               $e->getMessage();
            }
         }
      }
   }

   
}
?>
