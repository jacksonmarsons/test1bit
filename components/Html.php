<?php
namespace components;

class Html{
   static function renderPartial($path, $data = null){
      if($data){
         extract($data);
      }
      if(file_exists($file = (APP . '/views' . $path . '.php'))){
         include $file;
      }else{
         throw new \Exception("File $file not found.");
      }
   }

   static function render($path, $data = null){

      return self::renderPartial($path, ($data) ? $data : null);
   }
}
?>
