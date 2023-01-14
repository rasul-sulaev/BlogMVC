<div class="form-login">
    <h2 class="title mb-4">Регистрация</h2>
    <form class="transition-form" action="" method="post">
        <input type="hidden" name="account-registration" value="1">
        <div class="mb-3">
            <label class="form-label">ФИО</label>
            <input type="text" class="form-control" name="username" placeholder="Введите ФИО">
        </div>
        <div class="mb-3">
            <label class="form-label">Логин</label>
            <input type="text" class="form-control" name="login" placeholder="Введите логин">
        </div>
        <div class="mb-3">
            <label class="form-label">Адрес электронной почты</label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Введите email">
            <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input type="password" class="form-control" name="password" placeholder="Введите пароль">
        </div>
        <div class="mb-3">
            <label class="form-label">Подтверждение пароля</label>
            <input type="password" class="form-control" name="password2" placeholder="Введите пароль еще раз">
        </div>
        <button type="submit" class="btn btn-secondary w-100" name="button-reg">Зарегистириоваться</button>
        <p class="desc mt-3">Можете <a href="/account/login">авторизоваться</a>, если у вас есть аккаунт!</p>
    </form>
</div>