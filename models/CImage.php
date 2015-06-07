<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cnt_image".
 *
 * @property integer $id_image
 * @property resource $picture
 * @property integer $upload_date
 * @property string $blocks
 * @property string $questions
 * @property string $link
 */
class CImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $image;

    public static function tableName()
    {
        return 'cnt_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['picture', 'blocks', 'questions', 'filename'], 'string'],
            [['upload_date'], 'integer'],
            [['link'], 'string', 'max' => 255],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_image' => 'Id Image',
            'picture' => 'Picture',
            'upload_date' => 'Upload Date',
            'blocks' => 'Blocks',
            'questions' => 'Questions',
            'link' => 'Link',
        ];
    }
}
