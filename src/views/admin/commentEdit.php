<div class="main-content col-12 col-md-9">
    <div class="add-post">
        <h2 class="posts-title">Редактрирование комментария</h2>
        <form class="col-12 m-auto form" method="post">
            <input type="hidden" name="comment-edit" value="1">
            <div class="mb-3">
                <label class="form-label">Комментарий</label>
                <textarea class="form-control" rows="10" name="comment" placeholder="Введите комментарий"><?=$comment?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Статус модерации</label> <br>
                <input class="form-check-input" type="checkbox" id="ch" name="status" <? if (!empty($status)) echo 'checked'?>>
                <label class="form-label" for="ch">Опубликовать</label>
            </div>
            <button type="submit" class="btn btn-success w-100" name="edit-comment">Сохранить</button>
        </form>
    </div>
</div>