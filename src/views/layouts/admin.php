<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Finlandica:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/admin.css">
</head>
<body style="background-color: gainsboro">

    <? if ($_SERVER['REQUEST_URI'] !== '/admin/login'): ?>
    <div class="wrapper">
        <header class="container-fluid">
            <div class="container">
                <nav class="navbar col-8 d-flex justify-content-between navbar-expand-lg w-100">
                    <div class="col-4 d-flex align-items-center">
                        <a class="logo" href="/">Мой блог</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Переключатель навигации">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user fa-sm"></i>
                                    <?=$_SESSION['admin']['username']?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                    <li><a class="dropdown-item" href="/admin/logout">Выход</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <main>
            <section class="content">
                <div class="container h-100">
                    <div class="row h-100">
                        <div class="sidebar col-12 col-md-3">
                            <div class="content">
                                <section class="categories">
                                    <h4 class="title">Админка</h4>
                                    <ul>
                                        <li><a href="/admin/posts">Посты</a></li>
                                        <li><a href="/admin/categories">Категории</a></li>
                                        <li><a href="/admin/users">Пользователи</a></li>
                                        <li><a href="/admin/comments">Комментарии</a></li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                        <div class="main-content col-12 col-md-9">
                            <?=$content?>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <? else: ?>
    <div class="wrapper">
        <section class="loginSection">
            <?=$content?>
        </section>
    </div>
    <? endif; ?>


    <script src="https://kit.fontawesome.com/8f44be9bba.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script src="/public/js/main.js"></script>
</body>
</html>