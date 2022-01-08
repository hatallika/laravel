
<h1>Список новостей</h1>
<br>
<?php foreach ($news as $item): ?>
<div>
    <strong><a href="<?=route("news.show",['id' => $item['id']])?>"><?=$item['title']?></a></strong>
    <p><?=$item['description']?></p>
    <em>Автор: <?=$item['author']?></em>
    <br>
    <em>Категория: <?=$item['category']?></em>
    <hr>
</div>
<?php endforeach;?>
