<div class="form-login">
    <h1 class="mb-4 title">Авторизация</h1>
    <form class="form" action="" method="post">
        <input type="hidden" name="account-login" value="1">
        <div class="mb-3">
            <label class="form-label">Логин</label>
            <input class="form-control" type="text" name="login" placeholder="Введите логин" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input class="form-control" type="password" name="password" placeholder="Введите пароль" required>
        </div>
        <button class="btn btn-secondary" type="submit">Войти</button>
    </form>
    <p class="desc mt-3">Можете <a href="/account/registration">Зарегистрироваться</a>, если у вас нет аккаунта!</p>
</div>