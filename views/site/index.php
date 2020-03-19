<?php 


$parent_category = array();
$parent_item = array();
foreach ($categories as $category){
    $parent_category[$category['parent_id']][] = $category;
}

foreach ($items as $item){
    $parent_item[$item['category_id']][] = $item;
}

function renderItems($category_id, $parent_item){
    if(isset($parent_item[$category_id])){
        echo "<ul class='list-group main_category_list'>";
        foreach ($parent_item[$category_id] as $item){
            echo "<li class='list-group-item item_li'>";
            echo "<a onclick='return confirm(`Подтвердите удаление`)' href='/item/delete/".$item["id"]."' class='badge'><span class='glyphicon glyphicon-remove'> </span></a>";
            echo "<span class='badge glyphicon glyphicon-pencil' id='add_item' data-category_id=".$item['category_id']." data-item_id=".$item['id']."> </span>";
            echo "<span class='badge data_time_info'>".$item['update_at']."</span>";
            echo $item['title'];
            if($item['type']){
                echo "<p>Тип: ".$item['type']."</p>";
            }
            if($item['information']){
                echo "<p>Информация: ".$item['information']."</p>";
            }
            echo "</li>";
        }
        echo "</ul>";
    }
}

function outTree($parent_id, $parent_category, $parent_item){

    if(isset($parent_category[$parent_id])){
        if($parent_id == -1){
            echo "<ul class='list-group main_category_list main_ul'>";
        }else {
            echo "<ul class='list-group main_category_list children_ul'>";
        }
        foreach($parent_category[$parent_id] as $category){
            echo "<li class='list-group-item category_li'>";
            echo "<span class='badge count_item'>0</span>";
            echo "<a onclick='return confirm(`Подтвердите удаление`)' href='/category/delete/".$category["id"]."' class='badge'><span class='glyphicon glyphicon-remove'> </span></a>";
            echo "<span class='badge glyphicon glyphicon-pencil' id='add_category' data-category_id=".$category["id"]."> </span>";
            echo "<span class='badge glyphicon glyphicon-plus' id='add_item' data-category_id=".$category["id"]." data-item_id='0'> </span>";
            echo "<span class='badge data_time_info'>".$category['update_at']."</span>";
            echo $category['title'];
            //echo "<pre>"; print_r($category); die;
            if(($category['description'])){
                echo "<p> Описание категории: ".$category['description']."</p>";
            }
            outTree($category['id'], $parent_category, $parent_item);
            renderItems($category['id'], $parent_item);
            echo "</li>";
        }
        echo "</ul>";
    }
}

?>


<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <title>Test1bit</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" href="../../web/css/style.css"> 
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Test1bit</h1>
                </div>
            </div>
            <div class="row text-center">
                <button id="add_category" class="btn btn-primary btn-lg" data-category_id="0">Добавить категорию</button>
            </div>
            <div class="row text-center sort_select_box">
                <select class="form-control sort_select" id="secondary_sort_select">
                </select>
                <select class="form-control sort_select" id="main_sort_select">
                    <option value="0">Без сортировки</option>
                    <option value="1">По имени</option>                    
                    <option value="2">По дате</option>                    
                </select>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php outTree(-1, $parent_category, $parent_item); ?>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="Category_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            
        </div>

        <script src="/web/js/app.js"></script>
    </body>

</html>