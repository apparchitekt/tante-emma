<?php
    /* @var $this \yii\web\View */
    /* @var $content string */

    use app\widgets\Alert;
    use yii\helpers\Html;
    use app\assets\AppAsset;

    AppAsset::register($this);

    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
    $this->registerCssFile('static/fonts/source-sans-pro/loader.css');
    $this->registerCssFile('static/js/dropzone-5.7.0/dist/min/dropzone.min.css');
    $this->registerJsFile('static/js/dropzone-5.7.0/dist/min/dropzone.min.js', ['position' => \yii\web\View::POS_HEAD]);
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>

    <html lang="<?= Yii::$app->language ?>">
        <head>
            <meta charset="<?= Yii::$app->charset ?>">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	        <link rel="apple-touch-icon" href="favicon.ico">
            <?php $this->registerCsrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>
            <?php $this->head() ?>
        </head>

        <body id="<?= Yii::$app->request->pathInfo ?: 'index' ?>">
            <?php $this->beginBody() ?>
                <main class="container">
                    <?php if(!Yii::$app->user->isGuest) { ?>
                        <p id="backend-logo">
                            <a href="https://www.noz-medien.de/noz/noz-digital" target="_blank"><img src="static/img/logo.png"></a>
                        </p>

                        <p id="backend-menu">
                            <a class="btn btn-default" href="<?= Yii::$app->request->BaseUrl ?>/logout">Abmelden (<?= Yii::$app->user->identity->username ?>)</a>
                        </p>
                    <?php } ?>

                    <?= Alert::widget() ?>
                    <?= $content ?>
                </main>
            <?php $this->endBody() ?>
        </body>
    </html>
<?php $this->endPage() ?>