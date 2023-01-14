<div class="posts-table">
    <h2 class="posts-title">Управление категориями</h2>
    <div class="d-flex gap-2 my-3">
        <a class="btn btn-success w-auto" href="/admin/categories/add">Добавить новый</a> <br>
        <a class="btn btn-warning w-auto" href="/admin/categories">Список</a>
    </div>

    <table class="table table-light table-bordered table-striped table-hover">
        <thead class="table-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Название</th>
            <th scope="col">Управление</th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
        <? foreach ($categories as $category): ?>
            <tr scope="row">
                <th><?=$category['id']?></th>
                <td><a href="/category/<?=$category['link']?>"><?=$category['name']?></a></td>
                <td>
                    <a href="/admin/category/edit/<?=$category['id']?>">edit</a> |
                    <a class="get-confirm" href="/admin/category/delete/<?=$category['id']?>" data-confirm-content="Вы точно хотите удалить категорию <?=ucfirst($category['name']);?>?">delete</a>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</div>