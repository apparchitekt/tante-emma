<?php
    /* @var $this yii\web\View */

    use yii\widgets\ListView;
    use yii\data\ActiveDataProvider;

    $this->title = Yii::$app->name . ' — Angebote';
?>

<p class="text-right new-entry">
    <a href="entry" class="btn btn-primary">Neues Angebot</a>
</p>

<?= ListView::widget([
    'dataProvider' => $data,
    'layout' => '<div class="row">{items}</div>{pager}',
    'itemView' => 'listitem',
    'beforeItem' => function($model, $key, $index) {
        if($index % 2 === 0) return '</div><div class="row">';
    },
]) ?>
