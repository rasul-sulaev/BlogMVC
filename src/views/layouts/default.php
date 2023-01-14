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
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
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
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Главная</a></li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/about">О нас</a></li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/categories">Категории</a></li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/contacts">Контакты</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user fa-sm"></i>
                                    <? if (isset($_SESSION['admin'])): ?>
                                        <?=$_SESSION['admin']['username']; ?>
                                    <? elseif (isset($_SESSION['user'])): ?>
                                        <?=$_SESSION['user']['username']; ?>
                                    <? else: ?>
                                        Войти
                                    <? endif; ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <? if (isset($_SESSION['user'])): ?>
                                    <li><a class="dropdown-item" href="/account">Аккаунт</a></li>
                                    <li><a class="dropdown-item" href="/account/logout">Выход</a></li>
                                <? elseif (isset($_SESSION['admin'])): ?>
                                    <li><a class="dropdown-item" href="/admin">Админ панель</a></li>
                                    <li><a class="dropdown-item" href="/admin/logout">Выход</a></li>
                                <? else: ?>
                                    <li><a class="dropdown-item" href="/account/login">Войти</a></li>
                                    <li><a class="dropdown-item" href="/account/registration">Зарегистрироваться</a></li>
                                <? endif; ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <main>
            <section class="content">
                <div class="container">
                    <? if (!empty($top_posts)): ?>
                        <div class="row">
                            <h2 class="slider-title">Топ публикации</h2>
                        </div>
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <? foreach ($top_posts as $key => $post): ?>
                                    <div class="carousel-item <? if ($key === 0) echo 'active'; ?>">
                                        <img src="/uploads/img/posts/<?=$post['img']?>" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <a class="title" href="post/<?=$post['id']?>"><?=
                                                strlen($post['title']) >= 100 ?
                                                    mb_substr($post['title'], 0, 100, 'UTF8').'...' :
                                                    $post['title'];
                                                ?></a>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Предыдущий</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Следующий</span>
                            </button>
                        </div>
                    <? endif; ?>

                    <div class="row">
                        <div class="main-content col-12 col-md-9">
                            <?=$content?>
                        </div>

                        <div class="sidebar col-12 col-md-3">
                            <div class="content">
                                <section class="search">
                                    <h4 class="title">Поиск</h4>
                                    <form class="form" action="/" method="POST">
                                        <input type="text" name="query" class="form-control" placeholder="Найти...">
                                    </form>
                                </section>
                                <section class="categories">
                                    <h4 class="title">Категории</h4>
                                    <ul>
                                        <? foreach ($categories as $category): ?>
                                            <li><a href="/category/<?=$category['link']?>"><?=$category['name']?></a></li>
                                        <? endforeach; ?>
                                    </ul>
                                </section>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main>

        <footer class="container-fluid">
            <div class="container">
                <div class="row">
                    <section class="about col-md-6 col-12">
                        <h3 class="title">
                            <a class="logo" href="/">Мой блог</a>
                        </h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae eveniet iusto porro praesentium voluptatem. Aut blanditiis ducimus explicabo harum id molestiae nulla placeat quod tempora voluptatum? Inventore, obcaecati quisquam! Eligendi.
                        </p>
                        <div class="contacts">
                            <a href="#">
                                <i class="fa fa-phone"></i>
                                123-456-999
                            </a>
                            <a href="#">
                                <i class="fa fa-envelope"></i>
                                info@myblog.com
                            </a>
                        </div>
                        <div class="soc-links">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </div>
                    </section>
                    <section class="links col-md-3 col-12">
                        <h4 class="title">Категории</h4>
                        <ul>
                            <? foreach ($categories as $category): ?>
                                <li><a href="/category/<?=$category['name']?>"><?=$category['name']?></a></li>
                            <? endforeach; ?>
                        </ul>
                    </section>
                    <section class="feedback col-md-3 col-12">
                        <h4 class="title">Обратная связь</h4>
                        <form action="" method="post">
                            <input type="text" name="email" placeholder="Введите почту...">
                            <textarea name="message" placeholder="Введите сообщение..."></textarea>
                            <button type="submit">
                                <i class="fa fa-envelope"></i>
                                Отправить
                            </button>
                        </form>
                    </section>
                </div>
                <div class="footer-bottom row">
                    <p>&copy; myblog.com | Designed by <a href="https://t.me/Rasul_Mountain" target="_blank">Rasul Sulaev</a></p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://kit.fontawesome.com/8f44be9bba.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="/public/js/main.js"></script>
</body>
</html>