<?php
/**
 * @var \App\models\Good[] $goods
 */
?>
<?php foreach ($goods as $good) : ?>
    <h1><?= $good->name?></h1>
    <p>
        <a href="?c=good&a=one&id=<?= $good->id?>">
            Подробнее
        </a>
    </p>
<p><?= $good->price?></p>
<?php endforeach; ?>