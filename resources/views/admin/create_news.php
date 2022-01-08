<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Добавить новость</title>
    <form method="POST" action="<?=route("admin.news.store") ?>">
        <input type="hidden" name="_token" value="<?=csrf_token()?>" />

        <input type="text" placeholder="Введите заголовок новости" name="title">
        <br>
        <input type="text" placeholder="Введите анонс" name="description">
        <br>
        Категория новостей: <br>
        <select>
            <?php foreach ($categories as $key => $category): ?>

                <option value="<?= $key ?>"><?= $category ?></option>
            <?php endforeach ?>
        </select>
        <input type="submit" value="Создать">
    </form>
</head>
<body>

</body>
</html>
<?php
