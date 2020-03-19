<?php
namespace models;

use models\Model;
use components\DataBase;

class Category extends Model
{   
    public $id;
    public $title;
    public $create_at;
    public $update_at;
    public $description;
    public $parent_id;


    function __construct()
    {
        $this->id = 0;
        $this->title = "";
        $this->create_at = date("Y-m-d H:i:s");
        $this->update_at = date("Y-m-d H:i:s");
        $this->description = "";
        $this->parent_id = -1;
    }
    
    public static function getCategory($id)
    {
        $db = DataBase::dbConnect();
        $query = $db->prepare("SELECT * FROM category WHERE id=?");
        $query->execute([$id]);
        $bd = null;
        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public static function getCategorys()
    {   
        session_start();
        $main_param_sort = $_SESSION['main_param_sort'];
        $secondary_param_sort = $_SESSION['secondary_param_main'];

        $db = DataBase::dbConnect();
        $sql = "SELECT * FROM category";
        if($main_param_sort == 1){
            if($secondary_param_sort == 1){
                $sql = "SELECT * FROM category ORDER BY title ASC";
            }elseif($secondary_param_sort == 2){
                $sql = "SELECT * FROM category ORDER BY title DESC";
            }
        }elseif($main_param_sort == 2){
            if($secondary_param_sort == 1){
                $sql = "SELECT * FROM category ORDER BY update_at ASC";
            }elseif($secondary_param_sort == 2){
                $sql = "SELECT * FROM category ORDER BY update_at DESC"; 
            }
        }
        $result = $db->query($sql);
        $bd = null;
        return $result->fetchAll();
    }

    public static function addCategory($form)
    {
        $db = DataBase::dbConnect();
        $sql = "INSERT INTO category (title, create_at, update_at, description, parent_id) VALUES (:title, :create_at, :update_at, :description, :parent_id)";
        $query = $db->prepare($sql);
        $result = $query->execute( array( ':title'=>$form['title'], ':create_at'=>$form["create_at"], ':update_at'=>$form['update_at'], ':description'=>$form['description'], ':parent_id'=>$form['parent_id']));
        $bd = null;
        return $result;
    }

    public static function updateCategory($form)
    {
        $form['update_at'] = date("Y-m-d H:i:s");
        $db = DataBase::dbConnect();
        $sql = "UPDATE category SET title = '".$form['title']."', update_at = '".$form['update_at']."', description = '".$form['description']."', parent_id = '".$form['parent_id']."' WHERE id= '".$form['id']."'";
        $query = $db->prepare($sql);
        $result = $query->execute();
        $bd = null;
        return $result;
    }

    public static function removeCategory($id)
    {
        $db = DataBase::dbConnect();
        $sql = "DELETE FROM category WHERE id IN ($id)";
        $query = $db->prepare($sql);
        $result = $query->execute();
        $bd = null;
        return $result;
    }


}

?>