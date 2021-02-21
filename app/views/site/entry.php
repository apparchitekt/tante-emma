<?php
    /**
     * @var $this yii\web\View
     */

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $title = 'Angebot ' . ($model->id ? 'bearbeiten' : 'erstellen');
    $this->title = Yii::$app->name . ' — ' . $title;
?>

<h1><?= $title ?></h1>

<?php
    $form = ActiveForm::begin([
        'action' => 'upload',
        'options' => ['class' => 'dropzone'],
        'id' => 'images'
    ]);

    ActiveForm::end();
?>

<script>
    Dropzone.options.images = {
        paramName: 'imageFile',
        maxFiles: 10,
        maxFilesize: 1,
        acceptedFiles: '.jpg',
        addRemoveLinks: true,
        dictDefaultMessage: '<b>Angebotsbilder</b><br>Hier ablegen oder klicken<br>(JPG, max. 10 Dateien je 1 MB)',
        dictFileTooBig: 'Bitte verwenden Sie ausschließlich Bilddateien bis maximal 1 MB.',
        dictInvalidFileType: 'Bitte verwenden Sie ausschließlich Bilddateien des Typs JPG.',
        dictMaxFilesExceeded: 'Bitte verwenden Sie für das Angebot maximal {{maxFiles}} Dateien.',
        dictRemoveFile: 'Entfernen',
        dictCancelUpload: 'Abbrechen',

        init: function() {
            this.on('complete', file => {
                if(file.xhr) {
                    let imagesArray = $('#imagesInput').val().split(',');
                    imagesArray.push(file.xhr.response);
                    $('#imagesInput').val(imagesArray.join(','));
                }
            });

            this.on('removedfile', file => {
                if(file.xhr) {
                    removeFile(file.xhr.response);
                }
            });
        }
    };

    function removeFile(filename) {
        let imagesArray = $('#imagesInput').val().split(',');
        imagesArray = $.grep(imagesArray, item => {
            return item != filename;
        });

        $('#imagesInput').val(imagesArray.join(','));
    }
</script>

<?php if($model->id) { ?>
    <div class="imagebrowser">
        <?php foreach(explode(',', $model->images) as $item) { ?>
            <figure>
                <img class="delete" src="static/img/times-circle-solid.svg" onclick="removeFile('<?= $item ?>'); $(this).parent().hide()">
                <img class="preview" src="./uploads/<?= $item ?>">
            </figure>
        <?php } ?>
    </div>
<?php } ?>

<hr>

<?php $form = ActiveForm::begin() ?>
    <input type="hidden" value="<?= $model->id ?>">
    <?= $form->field($model, 'images', )->textInput(['id' => 'imagesInput']) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title') ?>
        </div>
    
        <div class="col-md-6">
            <div>
                <label><?= $model->attributeLabels()['stores'] ?></label>
                <span class="multiselect-toggle form-control"><?= implode(', ', array_intersect_key($model->storesArray, array_flip($model->stores))) ?></span>
            </div>

            <?= $form->field($model, 'stores')->checkboxList($model->storesArray, [
                'class' => 'multiselect-list required',
            ])->label(false) ?>

            <script>
                $("span.multiselect-toggle").click(function(event) {
                    $("div.multiselect-list").toggle();
                    event.stopPropagation();
                });

                $(document).click(function() {
                   if(event.target.tagName != 'LABEL' && event.target.tagName != 'INPUT') {
                        $("div.multiselect-list").hide();
                   }
                });

                $('div.multiselect-list input').click(function() {
                    let items = [];

                    $(this).parent().parent().find('input').each((index, item) => {
                        if(item.checked) {
                            items.push(item.nextSibling.nodeValue);
                        }
                    });

                    $('span.multiselect-toggle').html(items.join(', '));
                });
            </script>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'week')->dropDownList(
                $model->getWeeks($model->week ?: time(), 24, 'wednesday', 'Kalenderwoche %week% (%date%)'), [
                    'class' => 'form-control required',
                ],
            ) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'link')->textInput(['placeholder' => 'https://noz-digital.de']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Speichern', ['class' => 'btn btn-primary']) ?>
        <?php if($model->id) { ?>
            <a onclick="return confirm('Möchten Sie dieses Angebot löschen?')" class="btn btn-warning btn-space" href="<?= Yii::$app->urlManager->createAbsoluteUrl(['entry?delete&id=' . $model->id]) ?>">Löschen</a>
        <?php } ?>
        <a class="btn btn-secondary btn-space" onclick="window.history.back()">Abbrechen</a>
    </div>
<?php ActiveForm::end() ?>