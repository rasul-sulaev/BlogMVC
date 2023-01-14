<div class="posts-table">
    <h2 class="posts-title">Управление постами</h2>
    <div class="d-flex gap-2 my-3">
        <a class="btn btn-success w-auto" href="/admin/posts/add">Добавить новый</a> <br>
        <a class="btn btn-warning w-auto" href="/admin/posts">Список</a>
    </div>
    <table class="table table-light table-bordered table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Категория</th>
                <th scope="col">Автор</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Статус</th>
                <th scope="col" class="text-center">ТОП</th>
                <th scope="col">Управление</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <? foreach ($posts as $post): ?>
            <tr scope="row">
                <th><?=$post['id']?></th>
                <td>
                    <img src="/uploads/img/posts/<?=$post['img']?>" style="width: 40px; height: 40px" alt="">
                    <a href="/post/<?=$post['id']?>" title="<?=$post['title']?>"><?= mb_strlen($post['title']) > 30 ? mb_substr($post['title'], 0, 30).'...' : $post['title']?></a>
                </td>
                <td><a href="/category/<?=$post['category']?>"><?=$post['category']?></a></td>
                <td><?=$post['author']?></td>
                <td><?=$post['createdAt']?></td>
                <td>
                    <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                        <input type="hidden" name="change-post-status" value="<?=$post['id']?>">
                        <input type="hidden" name="id" value="<?=$post['id']?>">
                        <select class="form-select form-select-sm" name="status" onchange="this.form.submit()">
                            <option value="N" <? if ($post['status'] === "N") echo 'selected'; ?>>Не опубликован</option>
                            <option value="P" <? if ($post['status'] === "P") echo 'selected'; ?>>Опубликован</option>
                            <option value="D" <? if ($post['status'] === "D") echo 'selected'; ?>>В черновик</option>
                        </select>
                    </form>
                </td>
                <td class="text-center">
                    <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                        <input type="hidden" name="change-top-post" value="1">
                        <input type="hidden" name="id" value="<?=$post['id']?>">
                        <input class="form-check-input" type="checkbox" name="top_post" <? if ($post['top_post']) echo 'checked'?> onchange="this.form.submit()">
                    </form>
                </td>
                <td>
                    <a href="/admin/post/edit/<?=$post['id']?>">edit</a> |
                    <a class="get-confirm" href="/admin/post/delete/<?=$post['id']?>" data-confirm-content="Вы точно хотите удалить пост ID: <?=$post['id']?>?">delete</a>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</div>