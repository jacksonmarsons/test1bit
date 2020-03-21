<?php
use controllers\Controller;
use components\Html;
use models\Category;
use models\Item;


class SiteController extends Controller{

   public function actionIndex(){

      return Html::render('/site/index', [
         'categories' => Category::getCategorys(), 
         'items' => Item::getItems(),
      ]);
   }

   public function actionSort(){
      $main_param_sort = (int)json_decode(json_encode($_POST['sort_param_main']));
      $secondary_param_sort = (int)json_decode(json_encode($_POST['sort_param_secondary']));
      session_start();
      $_SESSION['main_param_sort'] = $main_param_sort;
      $_SESSION['secondary_param_main'] = $secondary_param_sort;
   }

}
?>
