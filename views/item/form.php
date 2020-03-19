<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">
                <?php 
                    if(isset($item->id)){
                        if($item->id == 0){
                            echo "Добавить элемент";
                        }else{
                            echo"Редактировать элемент";
                        }
                    }
                ?>
            </h4>
        </div>

        <form action="/item/save" method="post">
            <div class="modal-body text-center">
                <div class="form-group">
                    <label for="title">Название</label>
                    <input name="item[id]" type="hidden" value="<?=$item->id?>">

                    <label for="category_id">Родительская категория</label>
                    <select name="item[category_id]" id="category_id" data_parent_id="<?=$item->category_id;?>">
                        <?php 
                            foreach ($category_list as $category){
                                echo ("<option value='".$category['id']."'>".$category['title']."</option>");
                            }
                        ?>
                    </select>
                    <div></div>
                    <label for="title">Название</label>
                    <input name="item[title]" type="text" class="form-control" id="title" value="<?=$item->title?>">
                    <label for="type">Тип</label>
                    <input name="item[type]" type="text" class="form-control" id="type" value="<?=$item->type?>">
                </div>
                <input name="item[create_at]" type="hidden" value="<?=$item->create_at;?>">
                <input name="item[update_at]" type="hidden" value="<?=$item->update_at;?>">
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="item[information]" rows="5" class="form-control" id="information"><?=$item->information?></textarea>
                </div>                            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>


    </div>
</div>