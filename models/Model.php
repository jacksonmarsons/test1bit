<?php
namespace models;
use components\DataBase;

class Model{

   /**
   * Создание массива объектов из результата запроса
   * @return array objects
   */

   public static function createObjects($resault, $className){
      $models = [];
      foreach($resault->fetchAll() as $row){
         $model = new $className();
         foreach($row as $key => $value){
            $model->$key = $value;
         }
         $models[] = $model;
      }
      return $models;
   }

   /**
   * Создание объекта из результата запроса
   * @return object
   */

   public static function createObject($resault, $className){
      $model = new $className();
      foreach($resault->fetch() as $key => $value){
         $model->$key = $value;
      }
      return $model;
   }

   /**
   * Создание объекта из массива
   * @return object
   */

   public function createModel($array, $className){
      $model = new $className();
      foreach($array as $key => $value){
         $model->$key = $value;
      }
      return $model;
   }

   /**
   * Сохранение объекта в базу
   * @return boolean
   */

   public function save(){
      $db =  DataBase::dbConnect();
      $arrayFields = $this->getFileds($db, $this::tableName());
      $sql = $this->createSql($this, $arrayFields, $this::tableName());
      $resault = $db->query($sql);

      if($resault != null){
         return 1;
      }else{
         return 0;
      }
   }

   /**
   * Создания запроса для сохранения в базу
   * @return string
   */

   private function createSql($model, $arrayFields, $tableName){
      $sql = "INSERT INTO " . $tableName . " (";

      foreach($arrayFields as $field){
         if($field['Field'] == 'id'){
            continue;
         }
         $sql .= $field['Field'] . ', ';
      }
      $sql = substr($sql, 0, -2);
      $sql .= ") VALUES (";
      foreach($arrayFields as $field){
         $type = explode("(", $field['Type'])['0'];
         if($type == 'varchar'){
            $value = $model->$field['Field'];
            $sql  .= "'$value'" . ", ";
         }elseif($type == 'int'){
            if($field['Field'] == 'id'){
               continue;
            }else{
               $value = $model->$field['Field'];
               $sql .= $value;
            }
         }elseif($type = 'text'){
            $value = $model->$field['Field'];
            $sql  .= "'$value'" . ", ";
         }else{
            continue;
         }
      }
      $sql = substr($sql, 0, -2);
      $sql .= ")";

      return $sql;
   }

   /**
   * Получение полей таблицы
   * @return string
   */

   private function getFileds($db, $tableName){
      $resault = $db->query('SHOW COLUMNS FROM ' . $tableName);
      $resault->setFetchMode(\PDO::FETCH_ASSOC);

      if($resault){
         $fields = $resault->fetchAll();

         return $fields;
      }else{
         throw new Exception("Error! Not resault QUERY!", 1);
      }
   }
}
?>
