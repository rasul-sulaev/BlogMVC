<div class="main-content col-12 col-md-9">
<!--    --><?// get_admin_content_manager_bar($segments[1]); ?>
    <div class="add-post">
        <h2 class="posts-title">Редактрирование категории</h2>
        <form class="col-12 m-auto form" method="post">
            <input type="hidden" name="category-edit" value="1">
            <div class="mb-3">
                <label class="form-label">Название</label>
                <input type="text" class="form-control" name="name" value="<?=$name?>" placeholder="Введите название категории">
            </div>
            <div class="mb-3">
                <label class="form-label">Ссылка</label>
                <input type="text" class="form-control" name="link" value="<?=$link?>" placeholder="Введите ссылку категории">
            </div>
            <div class="mb-3">
                <label class="form-label">Описание категории</label>
                <textarea class="form-control" rows="10" name="description" placeholder="Введите описание категории"><?=$description?></textarea>
            </div>
            <button type="submit" class="btn btn-success w-100" name="edit-category">Сохоанить</button>
        </form>
    </div>
</div>