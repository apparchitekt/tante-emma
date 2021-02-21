<?php
    /* @var $this yii\web\View */
    /* @var $form yii\bootstrap\ActiveForm */
    /* @var $model app\models\LoginForm */

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = Yii::$app->name . ' — Anmeldung';
?>

<div id="login-container">
    <p id="login-logo">
        <a href="https://www.noz-medien.de/noz/noz-digital" target="_blank"><img src="static/img/logo.png"></a><br>
        Partner Backend für <?= Yii::$app->name ?>
    </p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'hidden'],
        ],
    ]) ?>

    <?= $form->field($model, 'username')->textInput(['placeholder' => $model->attributeLabels()['username']]) ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->attributeLabels()['password']]) ?>
   
    <div class="form-group">
        <?= Html::submitButton('Anmelden', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>