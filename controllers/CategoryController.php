<?php
use controllers\Controller;
use components\Html;
use models\Category;


class CategoryController extends Controller{

    public function actionForm($id) 
    {
        $category_list = Category::getCategorys();
        if($id == 0){
            $category = new Category();
        }else{
            $category = Category::getCategory($id);
        }
        return Html::render('/category/form', ['category' => $category, 'category_list' => $category_list]);
    }

    public function actionSave()
    {
        if($_POST['category']['id'] == 0){
            $result = Category::addCategory($_POST['category']);
        }else{
            $result = Category::updateCategory($_POST['category']);
        }

        if($result = 1){
            header ('Location: /');
            exit();
        }
    }

    private function addRemoveItem($parent_id, $parent_category, $remove_list){
        if(isset($parent_category[$parent_id])){
            foreach ($parent_category[$parent_id] as $category) {
                $remove_list[] = $category['id'];
                $remove_list = $this->addRemoveItem($category['id'], $parent_category, $remove_list);
            }
        }
        return $remove_list;
    }

    public function actionDelete($id)
    {
        $category_list = Category::getCategorys();

        $parent_category = array ();
        foreach ($category_list as $category){
            $parent_category[$category['parent_id']][] = $category;
        }

        $remove_list = array ();
        $remove_list[] = $id;

        $remove_list = $this->addRemoveItem($id, $parent_category, $remove_list);

        $results = array ();

        foreach ($remove_list as $remove_item){
            $results[] = Category::removeCategory($remove_item);
        }
        header ('Location: /');
        exit();

    }

}