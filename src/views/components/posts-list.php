<?php foreach ($posts as $post): ?>
    <div class="post row">
        <img class="post__img col-12 col-md-4" src="/uploads/img/posts/<?=$post['img']?>" alt="">
        <div class="post__text col-12 col-md-8">
            <a class="post__title" href="/post/<?=$post['id']?>"></i><?= mb_strlen($post['title']) > 100 ? mb_substr($post['title'], 0, 100).'...' : $post['title']?></a>
            <div class="post__info">
                <span><i class="fa fa-user" aria-hidden="true"></i><?=$post['author']?></span>
                <span><i class="fa fa-calendar" aria-hidden="true"></i><?=date("d-m-Y", strtotime($post['createdAt']));?></span>
                <span><i class="fa fa-folder" aria-hidden="true"></i><a href="/category/<?=$post['category_link']?>"><?=$post['category_name']?></a></span>
            </div>
            <p class="post__preview-text"><?= mb_strlen($post['text']) > 300 ? mb_substr($post['text'], 0, 300).'...' : $post['text'] ?></p>
        </div>
    </div>
<?php endforeach; ?>