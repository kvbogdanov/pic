<?php
/* @var $this yii\web\View */
?>
<h1>image/index</h1>

<?php

use yii\widgets\ActiveForm; // or yii\widgets\ActiveForm
use yii\helpers\Html;
use kartik\file\FileInput;
// or 'use kartik\file\FileInput' if you have only installed
// yii2-widget-fileinput in isolation
 
$form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
]);
echo $form->field($model, 'filename')->hiddenInput();
 
// your fileinput widget for single file upload
echo $form->field($model, 'image')->widget(FileInput::classname(), [
    'options'=>['accept'=>'image/*'],
    'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]
]);

/*
* uncomment for multiple file upload
*
	echo $form->field($model, 'image[]')->widget(FileInput::classname(), [
	    'options'=>['accept'=>'image/*', 'multiple'=>true],
	    'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
	]);
*
*/
echo Html::submitButton($model->isNewRecord ? 'Upload' : 'Update', [
    'class'=>$model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
);
ActiveForm::end();