<?php

    namespace app\models;

    use yii\base\Model;
    use yii\web\UploadedFile;

    /**
     * @var UploadImageForm
     */

    class UploadImageForm extends Model {
        public $imageFile;

        public function rules() {
            return [
                [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg'],
            ];
        }

        public function upload() {            
            if($this->validate()) {
                $filename = uniqid() . '.' . $this->imageFile->extension;
                $this->imageFile->saveAs("./uploads/$filename");
                return $filename;
            }

            return false;
        }
    }
?>