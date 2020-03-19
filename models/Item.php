<?php
namespace models;

use models\Model;
use components\DataBase;

class Item extends Model
{

    public $id;
    public $category_id;
    public $title;
    public $create_at;
    public $update_at;
    public $type;
    public $information;

    function __construct()
    {
        $this->id = 0;
        $this->category_id = 0;
        $this->title = "";
        $this->create_at = date("Y-m-d H:i:s");
        $this->update_at = date("Y-m-d H:i:s");
        $this->type = "";
        $this->information = "";
    }

    public static function addItem($form)
    {
        $db = DataBase::dbConnect();
        $sql = "INSERT INTO item (category_id, title, create_at, update_at, type, information) 
                VALUES (:category_id, :title, :create_at, :update_at, :type, :information)";
        $query = $db->prepare($sql);
        $result = $query->execute( array( ':category_id'=>$form['category_id'], ':title'=>$form["title"], ':create_at'=>$form['create_at'], ':update_at'=>$form['update_at'], ':type'=>$form['type'], ':information'=>$form['information']));
        $bd = null;
        return $result;
    }

    public static function updateItem($form)
    {
        $form['update_at'] = date("Y-m-d H:i:s");
        $db = DataBase::dbConnect();
        $sql = "UPDATE item SET category_id = '".$form['category_id']."', title = '".$form['title']."', update_at = '".$form['update_at']."', type = '".$form['type']."', information = '".$form['information']."' WHERE id= '".$form['id']."'";
        $query = $db->prepare($sql);
        $result = $query->execute();
        $bd = null;
        return $result;
    }

    public static function getItem($id)
    {
        $db = DataBase::dbConnect();
        $query = $db->prepare("SELECT * FROM item WHERE id=?");
        $query->execute([$id]);
        $bd = null;
        return $query->fetch(\PDO::FETCH_OBJ);
    }

    public static function getItems()
    {
        
        $main_param_sort = $_SESSION['main_param_sort'];
        $secondary_param_sort = $_SESSION['secondary_param_main'];

        $db = DataBase::dbConnect();
        $sql = "SELECT * FROM item";
        if($main_param_sort == 1){
            if($secondary_param_sort == 1){
                $sql = "SELECT * FROM item ORDER BY title ASC";
            }elseif($secondary_param_sort == 2){
                $sql = "SELECT * FROM item ORDER BY title DESC";
            }
        }elseif($main_param_sort == 2){
            if($secondary_param_sort == 1){
                $sql = "SELECT * FROM item ORDER BY update_at ASC";
            }elseif($secondary_param_sort == 2){
                $sql = "SELECT * FROM item ORDER BY update_at DESC"; 
            }
        }
        $result = $db->query($sql);
        $bd = null;
        return $result->fetchAll();
    }

    public static function removeItem($id)
    {
        $db = DataBase::dbConnect();
        $sql = "DELETE FROM item WHERE id IN ($id)";
        $query = $db->prepare($sql);
        $result = $query->execute();
        $bd = null;
        return $result;
    }


}