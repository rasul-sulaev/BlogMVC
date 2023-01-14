<div class="posts-table">
    <h2 class="posts-title">Управление пользователями</h2>
    <div class="d-flex gap-2 my-3">
        <a class="btn btn-success w-auto" href="/admin/users/add">Добавить новый</a> <br>
        <a class="btn btn-warning w-auto" href="/admin/users">Список</a>
    </div>
    <table class="table table-light table-bordered table-striped table-hover">
        <thead class="table-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Логин</th>
            <th scope="col">Почта</th>
            <th scope="col">Дата регистрации</th>
            <th scope="col">Роль</th>
            <th scope="col">Статус</th>
            <th scope="col">Управление</th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
        <? foreach ($users as $user): ?>
            <tr scope="row">
                <th><?=$user['id']?></th>
                <td><a href="#"><?=$user['username']?></a></td>
                <td><a href="#"><?=$user['email']?></a></td>
                <td><?=$user['createdAt']?></td>
                <td>
                    <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                        <input type="hidden" name="change-user-role" value="1">
                        <input type="hidden" name="id" value="<?=$user['id']?>">
                        <select name="role" onchange="this.form.submit()">
                            <option value="admin" <? if ($user['role'] === 'admin') echo "selected"; ?>>Админ</option>
                            <option value="user" <? if ($user['role'] === "user") echo "selected"; ?>>Пользователь</option>
                        </select>
                    </form>
                </td>
                <td>
                    <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                        <input type="hidden" name="change-user-status" value="1">
                        <input type="hidden" name="id" value="<?=$user['id']?>">
                        <select name="status" onchange="this.form.submit()">
                            <option value="active" <? if ($user['status'] === 'active') echo "selected"; ?>>Активен</option>
                            <option value="ban" <? if ($user['status'] === "ban") echo "selected"; ?>>Заблокирован</option>
                            <option value="deleted" <? if ($user['status'] === "deleted") echo "selected"; ?>>Удален</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href="/admin/user/edit/<?=$user['id']?>">edit</a> |
                    <a class="get-confirm" href="/admin/user/delete/<?=$user['id']?>" data-confirm-content="Вы точно хотите удалить пользователя <?=ucfirst($user['username']);?>?">delete</a>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</div>