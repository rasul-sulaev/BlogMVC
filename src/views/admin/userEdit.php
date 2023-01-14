<div class="main-content col-12 col-md-9">
<!--    --><?// get_admin_content_manager_bar($segments[1]); ?>
    <div class="add-post">
        <h2 class="posts-title">Редактирование пользователя</h2>
        <form class="col-12 m-auto form" method="post">
            <input type="hidden" name="user-edit" value="1">
            <div class="mb-3">
                <label for="exampleInputLogin" class="form-label">ФИО</label>
                <input type="text" class="form-control" id="exampleInputLogin" name="username" value="<?=$username?>" placeholder="Введите ФИО">
            </div>
            <div class="mb-3">
                <label for="exampleInputLogin" class="form-label">Логин</label>
                <input type="text" class="form-control" id="exampleInputLogin" name="login" value="<?=$login?>" placeholder="Введите логин">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?=$email?>" aria-describedby="emailHelp" placeholder="Введите email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль (Старый или Новый)</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Введите пароль">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword2" class="form-label">Подтверждение пароля</label>
                <input type="password" class="form-control" id="exampleInputPassword2" name="password2" placeholder="Введите пароль еще раз" >
            </div>
            <div class="mb-3">
                <label class="form-label">Роль</label>
                <select class="form-select" name="role">
                    <option selected disabled>Выберите роль пользователя</option>
                    <option value="admin" <? if ($role === 'admin') echo "selected"; ?>>Админ</option>
                    <option value="user" <? if ($role === 'user') echo "selected"; ?>>Пользователь</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Статус</label>
                <select class="form-select" name="status">
                    <option selected disabled>Выберите статус пользователя</option>
                    <option value="active" <? if ($status === 'active') echo "selected"; ?>>Активен</option>
                    <option value="ban" <? if ($status === 'ban') echo "selected"; ?>>Заблокирован</option>
                    <option value="deleted" <? if ($status === 'deleted') echo "selected"; ?>>Удален</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100" name="edit-user">Сохранить</button>
        </form>
    </div>
</div>