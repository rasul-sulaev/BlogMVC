<div class="add-post">
    <h2 class="posts-title">Добавление нового пользователя</h2>
    <form class="col-12 m-auto form" action="<?=$_SERVER['REQUEST_URI']?>" method="post">
        <input type="hidden" name="user-add" value="1">
        <div class="mb-3">
            <label for="exampleInputLogin" class="form-label">ФИО</label>
            <input type="text" class="form-control" id="exampleInputLogin" name="username" placeholder="Введите ФИО">
        </div>
        <div class="mb-3">
            <label for="exampleInputLogin" class="form-label">Логин</label>
            <input type="text" class="form-control" id="exampleInputLogin" name="login" placeholder="Введите логин">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Введите email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Введите пароль">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Подтверждение пароля</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password2" placeholder="Введите пароль еще раз">
        </div>
        <div class="mb-3">
            <label class="form-label">Роль</label>
            <select class="form-select" name="role">
                <option value="0" selected disabled>Выберите роль пользователя</option>
                <option value="admin">Админ</option>
                <option value="user">Пользователь</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success w-100">Добавить</button>
    </form>
</div>