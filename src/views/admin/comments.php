<h2 class="posts-title">Управление комментариями</h2>
<table class="table table-light table-bordered table-striped table-hover">
    <thead class="table-light">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Текст</th>
        <th scope="col">Пост</th>
        <th scope="col">Автор</th>
        <th scope="col">Дата создания</th>
        <th scope="col">Опубликован</th>
        <th scope="col">Управление</th>
    </tr>
    </thead>
    <tbody class="table-group-divider">
    <? foreach ($comments as $comment): ?>
        <tr scope="row">
            <th><?=$comment['id']?></th>
            <td>
                <span title="<?=$comment['comment']?>"><?= strlen($comment['comment']) >= 50 ?
                mb_substr($comment['comment'], 0, 50, 'UTF8').'...' :
                $comment['comment']; ?></span>
            </td>
            <td>
                <a href="/post/<?=$comment['id_post']?>#comments">Перейти</a>
            </td>
            <th>
                <?=$comment['username']?> <br>
                <a href="#"><?=$comment['user_email']?></a>
            </th>
            <td>
                <?=$comment['createdAt']?>
            </td>
            <td class="text-center">
                <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                    <input type="hidden" name="change-comment-status" value="1">
                    <input type="hidden" name="id" value="<?=$comment['id']?>">
                    <input class="form-check-input" type="checkbox" name="status" <? if (!empty($comment['status'])) echo 'checked'?> onchange="this.form.submit()">
                </form>
            </td>
            <td>
                <a href="/admin/comment/edit/<?=$comment['id']?>">edit</a> |
                <a class="get-confirm" href="/admin/comment/delete/<?=$comment['id']?>" data-confirm-content="Вы точно хотите удалить комментарий ID: <?=$comment['id'];?>?">delete</a>
            </td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>