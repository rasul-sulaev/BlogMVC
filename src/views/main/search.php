<div class="posts">
    <? if (empty($posts)): ?>
<!--        <h1>Error 404</h1>-->
        <h3>По ваще запросу: <b><i><?=$query;?></i></b> ничего не найдено :(</h3>
    <? else: ?>
        <h2 class="mb-4">Резултаты поиска:</h2>
        <?php include "../src/views/components/posts-list.php"; ?>
    <? endif; ?>
</div>