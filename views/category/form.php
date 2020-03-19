<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">
                <?php 
                    if(isset($category->id)){
                        if($category->id == 0){
                            echo "Добавить категорию";
                        }else{
                            echo"Редактировать категорию";
                        }
                    }
                ?>
            </h4>
        </div>

        <form action="/category/save" method="post">
            <div class="modal-body text-center">
                <div class="form-group">
                    <label for="title">Название</label>
                    <input name="category[id]" type="hidden" value="<?=$category->id?>">
                    <input name="category[title]" type="text" class="form-control" id="title" value="<?=$category->title?>">
                </div>
                <input name="category[create_at]" type="hidden" value="<?=$category->create_at;?>">
                <input name="category[update_at]" type="hidden" value="<?=$category->update_at;?>">
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea name="category[description]" rows="5" class="form-control" id="description"><?=$category->description?></textarea>
                </div>                            
                <div>
                    <label for="parent_id">Родительская категория</label>
                    <select name="category[parent_id]" id="parent_id" data_parent_id="<?=$category->parent_id;?>">
                        <option value="-1">Нет родительской категории</option>
                        <?php 
                            foreach ($category_list as $category){
                                echo ("<option value='".$category['id']."'>".$category['title']."</option>");
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>


    </div>
</div>