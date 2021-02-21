<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\EntryForm;

    $entry = new EntryForm();
    $storesArray = $entry->storesArray;
?>

<article class="item col-md-6" data-key="<?= $model->id ?>">
    <div class="inner">
        <h3>Kalenderwoche <?= date('W', $model->week) ?> (<?= date('d.m.Y', $model->week) ?>)</h3>
        <p class="stores"><?= implode(', ', array_intersect_key($storesArray, array_flip(explode(',', $model->stores)))) ?></p>
        <h4><?= $model->title ?></h4>

        <figure>
            <a href="entry?id=<?= $model->id ?>">
                <img src="uploads/<?= explode(',', $model->images)[0] ?? false ?>">
            </a>
        </figure>
        
        <p class="edit">
            <a class="btn btn-primary btn-sm" href="entry?id=<?= $model->id ?>">Bearbeiten</a>
        </p>
    </div>
</article>
