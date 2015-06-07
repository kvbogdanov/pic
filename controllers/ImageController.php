<?php

namespace app\controllers;

use Yii;
use app\models\CImage;
use yii\web\UploadedFile;

class ImageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new CImage;
        if ($model->load(Yii::$app->request->post())) {
            // get the uploaded file instance. for multiple file uploads
            // the following data will return an array
            $image = UploadedFile::getInstance($model, 'image');

            // store the source file name
            $model->filename = $image->name;
            $ext = end((explode(".", $image->name)));

            // generate a unique file name
            $model->picture = Yii::$app->security->generateRandomString().".{$ext}";

            // the path to save file, you can set an uploadPath
            // in Yii::$app->params (as used in example below)
            $path = Yii::$app->params['uploadPath'] . $model->picture;

            if($model->save()){
                $image->saveAs($path);
                //return $this->redirect(['view', 'id'=>$model->_id]);
            } else {
                // error in saving model
            }
        }

        return $this->render('index', [
        	'model' => $model
        ]);
    }

    public function actionView()
    {
        $image = CImage::findOne(2);

        return $this->render('view', [
        	'model' => $image
        ]);

    }

}
