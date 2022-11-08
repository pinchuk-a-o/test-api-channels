<?php

namespace backend\models\ars;

use Yii;

/**
 * This is the model class for table "channel".
 *
 * @property int $id
 * @property string $created_at
 * @property string|null $updated_at
 * @property string $title
 * @property string|null $url
 * @property string|null $logo
 * @property string|null $description
 */
class Channel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'channel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 40],
            [['url', 'logo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'title' => 'Название телеканала',
            'url' => 'Ссылка на поток',
            'logo' => 'Логотип',
            'description' => 'Описание',
        ];
    }
}
