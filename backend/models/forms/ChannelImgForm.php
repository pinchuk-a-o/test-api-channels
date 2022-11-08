<?php

namespace backend\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class ChannelImgForm extends Model
{
    public $logo;
    public bool $delete_img = false;

    public function rules()
    {
        return [
            [['delete_img'], 'boolean', 'skipOnEmpty' => true],
            [['logo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'delete_img' => 'Удалить текущее изображение',
            'logo' => 'Логотип',
        ];
    }
}