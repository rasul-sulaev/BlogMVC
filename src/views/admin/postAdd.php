<div class="add-post">
    <h2 class="posts-title">Добавление нового поста</h2>
    <form class="col-12 m-auto form" action="<?=$_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="post-add" value="1">
        <div class="mb-3">
            <label class="form-label">Название</label>
            <input type="text" class="form-control" name="title" placeholder="Введите название поста">
        </div>
        <div class="mb-3">
            <label class="form-label">Содержание поста</label>
            <textarea class="form-control" id="editor" rows="10" name="text" placeholder="Введите содержимое поста"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Картинка</label>
            <input class="form-control" type="file" name="img">
        </div>
        <div class="mb-3">
            <label class="form-label">Категория поста</label>
            <select class="form-select" name="category" required>
                <option value="0" selected disabled>Выберите категорию поста</option>
                <? foreach ($categories as $category): ?>
                    <option value="<?=$category['id']?>"><?=$category['name']?></option>
                <? endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Статус публикации</label>
            <select class="form-select" name="status">
                <option value="N">Не опубликовать</option>
                <option value="P" selected>Опубликовать</option>
                <option value="D">В черновик</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success w-100" name="create-post">Добавить пост</button>
    </form>
</div>