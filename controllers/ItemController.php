<?php
use controllers\Controller;
use components\Html;
use models\Category;
use models\Item;

class ItemController extends Controller
{

    public function actionForm($category_id, $item_id)
    {
        $category_list = Category::getCategorys();
        if($item_id == 0){
            $item = new Item();
            $item->category_id = $category_id;
        }else{
            $item = Item::getItem($item_id);
        }
        return Html::render('/item/form', ['item' => $item, 'category_list' => $category_list]);
    }

    public function actionSave()
    {
        if($_POST['item']['id'] == 0){
            $result = Item::addItem($_POST['item']);
        }else{
            $result = Item::updateItem($_POST['item']);
        }

        if($result = 1){
            header ('Location: /');
            exit();
        }
    }

    public function actionDelete($id)
    {
        $results = Item::removeItem($id);
        header ('Location: /');
        exit();

    }

}

?>