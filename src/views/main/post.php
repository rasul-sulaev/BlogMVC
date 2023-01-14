<div class="single_post">
    <h2 class="single_post__title"><?=$post['title']?></h2>
    <div class="single_post__info">
        <span><i class="fa fa-user"></i><?=$post['author']?></span>
        <span><i class="fa fa-calendar"></i><?=$post['createdAt']?></span>
        <span><i class="fa fa-folder"></i><a href="/category/<?=$post['category_link']?>"><?=$post['category_name']?></a></span>
    </div>
    <img class="single_post__img col-12" src="/uploads/img/posts/<?=$post['img']?>" alt="">
    <div class="single_post__text"><?=$post['text']?></div>
</div>

<div id="comments" class="col-md-12 col-12 comments pt-5">
    <h3 class="mb-3">Оставить комментарий</h3>
    <? if (isset($_SESSION['user']) || isset($_SESSION['admin'])): ?>
        <form class="transition-form" action="/post/<?=$post['id']?>" method="post">
            <div class="mb-3">
                <textarea class="form-control" name="comment" rows="5" placeholder="Введите комментарий"></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-secondary w-100" style="border-radius: 0" name="send-comment">Отправить</button>
            </div>
        </form>
    <? else: ?>
        <blockquote class="comments-blocked">
            <p class="not">Только авторизованные пользователи могут оставлять комментарии. <a href="/account/login">Войдите</a>, пожалуйста!</p>
        </blockquote>
    <? endif; ?>

    <? if (!empty($comments)): ?>
        <div class="all-comments mt-5">
            <h4 class="mb-3">Комментарии <span>(<?=count($comments)?>)</span></h4>
            <? foreach ($comments as $comment): ?>
                <div class="comment col-12">
                    <div class="comment__info">
                        <span><i class="fa fa-user"></i>
                            <?=$comment['username']?>
                            <? if ($comment['user_role'] === 'admin'): ?>
                                <span class='this-admin'>Админ</span>
                            <? elseif (isset($_SESSION['user']) && ($comment['id_user'] === $_SESSION['user']['id'])): ?>
                                <span class='this-you'>Вы</span>
                            <? endif; ?>
                        </span>
                        <span class="date"><i class="fa fa-calendar-days" style="margin-left: auto"></i><? $date = date_parse($comment['createdAt']); echo "{$date['day']}.{$date['month']}.{$date['year']}"?></span>
                    </div>
                    <div class="comment__text"><?=$comment['comment']?></div>
                </div>
            <? endforeach; ?>
        </div>
    <? endif; ?>
</div>