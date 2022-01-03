<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Категории новостей</title>
</head>
<body>
    <h1>Категории новостей</h1>
    <ul>
        <?php foreach ($categories as $idx_category => $category):?>
            <li><a href="<?=route("news.category",['idx_category' => $idx_category])?>"><?=$category?></a></li>
        <?php endforeach;?>

    </ul>
</body>
</html>
<?php
