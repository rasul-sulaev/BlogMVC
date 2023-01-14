<div class="posts">
    <h2>Категория: <?=$category['name']?></h2>
    <blockquote class="mb-4"><?=$category['description']?></blockquote>
    <? if (count($posts) === 1): ?>
        <p style="font-style: italic">Найден: 1 пост</p>
    <? elseif (count($posts) >= 2 && count($posts) < 5): ?>
        <p style="font-style: italic">Найдено: <?=count($posts)?> поста</p>
    <? else: ?>
        <p style="font-style: italic">Найдено: <?=count($posts )?> постов</p>
    <? endif; ?>

    <?php include "../src/views/components/posts-list.php"; ?>
</div>


