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
                return $this->redirect(['view', 'id'=>$model->id_image]);
            } else {
                // error in saving model
            }
        }

        return $this->render('index', [
        	'model' => $model
        ]);
    }

    public function actionView($id)
    {
        $image = CImage::findOne($id);

        if(!empty($image->blocks))
        	$this->redirect("/");

        return $this->render('view', [
        	'model' => $image
        ]);

    }

    public function actionUpdate(){
    	if(!isset($_POST['id'])) die();

        $image = CImage::findOne($_POST['id']);

        $image->blocks = $_POST['info'];

        if($image->save())
        	echo 'saved';
    }

    private function imageCreateFromAny($filepath) {
	    $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
	    $allowedTypes = array(
	        1,  // [] gif
	        2,  // [] jpg
	        3,  // [] png
	        6   // [] bmp
	    );
	    if (!in_array($type, $allowedTypes)) {
	        return false;
	    }
	    switch ($type) {
	        case 1 :
	            $im = imageCreateFromGif($filepath);
	        break;
	        case 2 :
	            $im = imageCreateFromJpeg($filepath);
	        break;
	        case 3 :
	            $im = imageCreateFromPng($filepath);
	        break;
	        case 6 :
	            $im = imageCreateFromBmp($filepath);
	        break;
	    }
	    return $im;
	}

    public function actionPreview($id)
    {

		$image = CImage::findOne($id);

		$blocks = [];

		$not_showed = [];
		if(isset($_GET['b']))
			$not_showed = explode("_", $_GET['b']);


		if(json_decode($image->blocks))
		{
			$blocks = json_decode($image->blocks)->blocks;
			$newwidth = json_decode($image->blocks)->width;
			$newheight = json_decode($image->blocks)->height;
		}
		else
			die();


			$strImagePath = Yii::$app->params['uploadPath'] . $image->picture;

			$srcimg = $this->imageCreateFromAny($strImagePath);
			list($width, $height) = getimagesize($strImagePath);

			$img = imagecreatetruecolor($newwidth, $newheight);

			imagecopyresized($img, $srcimg, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

			$black = imagecolorallocate($img, 0, 0, 0);


			foreach ($blocks as $key => $block) {
				if(!in_array($block->code, $not_showed))
					imagefilledrectangle($img, $block->x, $block->y, ($block->x + $block->width), ($block->y + $block->height), $black);
			}


			header("Content-type: image/png");
			imagePng($img);


    }

    public function actionShow($code)
    {
    	$image = CImage::find()->where('picture LIKE :query')->addParams([':query' => $code."%"])->one();

        return $this->render('show', [
        	'model' => $image
        ]);
    }

}
