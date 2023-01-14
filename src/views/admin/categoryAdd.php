<div class="add-post">
    <h2 class="posts-title">Добавление новой категории</h2>
    <form class="col-12 m-auto form" action="<?=$_SERVER['REQUEST_URI']?>" method="post">
        <input type="hidden" name="category-add" value="1">
        <div class="mb-3">
            <label class="form-label">Ссылка</label>
            <input type="text" class="form-control" name="link" placeholder="Введите ссылку категории" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Название</label>
            <input type="text" class="form-control" name="name" placeholder="Введите название категории" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Описание категории</label>
            <textarea class="form-control" rows="10" name="description" placeholder="Введите описание категории"></textarea>
        </div>
        <button type="submit" class="btn btn-success w-100">Создать категорию</button>
    </form>
</div>