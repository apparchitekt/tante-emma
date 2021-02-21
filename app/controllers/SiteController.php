<?php

    namespace app\controllers;

    use Yii;
    use yii\filters\AccessControl;
    use yii\web\Controller;
    use yii\web\UploadedFile;
    use yii\web\Response;
    use yii\data\ActiveDataProvider;
    use yii\imagine\Image;
    use app\models\LoginForm;
    use app\models\UploadImageForm;
    use app\models\EntryForm;
    use app\models\Entries;
    use Imagine\Image\Box;
    
    class SiteController extends Controller {

        /**
         * @return array behaviors
         */

        public function behaviors() {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'entry', 'upload'],
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ];
        }

        /**
         * @return array actions
         */

        public function actions() {
            return [
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ],
            ];
        }

        /**
         * Action for login
         * 
         * @return string rendered page
         */

        public function actionLogin() {
            if(!Yii::$app->user->isGuest) {
                return $this->goHome();
            }

            $model = new LoginForm();
            
            if($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            }

            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }

        /**
         * Action for logout
         * 
         * @return string rendered page
         */
        
        public function actionLogout() {
            Yii::$app->user->logout();
            return $this->goHome();
        }

        /**
         * Action for index page (entries)
         * 
         * @return string rendered page
         */

        public function actionIndex() {
            $dataProvider = new ActiveDataProvider([
                'query' => Entries::find()->orderBy('week DESC'),
                'pagination' => [
                    'pageSize' => 4,
                ],
            ]);

            return $this->render('entries', ['data' => $dataProvider]);
        }

        /**
         * Action for creating and editing entry
         * 
         * @return string rendered page
         */

        public function actionEntry() {
            $model = new EntryForm();
            $entry = ($id = (int) Yii::$app->request->get('id')) ? $model->getEntry($id) : false;

            // Save and set data
            // I'm sure this can be handled better in Yii but had not enough time to learn
            if($model->load(Yii::$app->request->post())) {
                if($model->validate()) {
                    $entry = $entry ?: new Entries;
                    $entry->title = $model->title;
                    $entry->stores = implode(',', $model->stores);
                    $entry->week = $model->week;
                    $entry->link = preg_replace('/^(?!https?:\/\/)/', 'http://', $model->link); // Add http if missing
                    $entry->images = trim($model->images, ',');
                    $entry->save();
    
                    return $this->goHome();
                }   
            } else {
                $model->id = $entry->id ?? false;
                $model->title = $entry->title ?? false;
                $model->stores = explode(',', $entry->stores ?? false);
                $model->week = $entry->week ?? false;
                $model->link = $entry->link ?? false;
                $model->images = $entry->images ?? false;
            }

            // Delete data and files
            if(isset($_GET['delete']) && $entry) {
                $model->deleteImages($entry);
                $entry->delete();

                return $this->goHome();
            }

            return $this->render('entry', ['model' => $model]);
        }

        /**
         * Action for uploading images for entry
         * 
         * @return string|false basename of uploaded file
         */

        public function actionUpload() {
            $model = new UploadImageForm();
            
            if(Yii::$app->request->isPost) {
                $model->imageFile = UploadedFile::getInstanceByName('imageFile');

                if($filename = $model->upload()) {
                    // $imagine = Image::getImagine()->open("./uploads/$filename")->thumbnail(new Box(600, 500))->save();
                    return $filename;
                }
            }

            return false;
        }

        /**
         * Action for API calls (XML for external sites)
         * 
         * @return string xml content
         */

        public function actionApi() {
            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
            Yii::$app->response->headers->add('content-type', 'text/xml');
        
            if($store = Yii::$app->request->get('store')) {
                $data = [
                    'entry' => Entries::find()
                        ->where(['<=', 'week', strtotime('next wednesday')])
                        ->andWhere(new \yii\db\Expression('FIND_IN_SET(:store, stores)'))
                        ->addParams([':store' => $store])
                        ->orderBy('week DESC')->one(),
                    'store' => $store,
                    'path' => 'https://app-architekt.de/noz-digital/tante-emma/web/uploads',
                ];

                if($data['entry']) {
                    $data['entry']->images = implode(',', array_map(function($item) use ($data) {
                        return "$data[path]/$item";
                    }, explode(',', $data['entry']->images)));

                    return $this->renderPartial('api', $data);
                } else {
                    return '<message><error>No entry found</error></message>';
                }
            } else {
                return '<message><error>No store given</error></message>';
            }
        }
    }
