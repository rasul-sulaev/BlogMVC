<div class="add-post">
<!--    --><?// get_admin_content_manager_bar($segments[1]); ?>
    <h2 class="posts-title">Редактирование поста</h2>
    <form class="col-12 m-auto form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="post-edit" value="1">
        <div class="mb-3">
            <label class="form-label">Название</label>
            <input type="text" class="form-control" name="title" value="<?=$post_title?>" placeholder="Введите название поста">
        </div>
        <div class="mb-3">
            <label class="form-label">Содержание поста</label>
            <textarea class="form-control" id="editor" rows="10" name="text" placeholder="Введите содержимое поста"><?=$text?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Картинка</label>
            <? if (!empty($img)): ?>
                <br>
                <img src="/uploads/img/posts/<?=$img?>" width="200" alt="">
                <br>
                <br>
            <? endif; ?>
            <input class="form-control" type="file" name="img">
        </div>
        <div class="mb-3">
            <label class="form-label">Категория поста</label>
            <select class="form-select" name="category">
                <option value="1" selected disabled>Выберите категорию поста</option>
                <? foreach ($categories as $item): ?>
                    <option value="<?=$item['id']?>" <? if ($item['id'] == $category) echo "selected"; ?>><?=$item['name']?></option>
                <? endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Статус публикации</label>
            <br>
            <select class="form-select" name="status">
                <option value="N" <? if ($status === "N") echo "selected"; ?>>Не опубликовать</option>
                <option value="P" <? if ($status === "P") echo "selected"; ?>>Опубликовать</option>
                <option value="D" <? if ($status === "D") echo "selected"; ?>>В черновик</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success w-100">Сохранить</button>
    </form>
</div>