<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "survey".
 *
 * @property int $id Record ID
 * @property string $title Title
 */
class Survey extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'survey';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Record ID'),
            'title' => Yii::t('app', 'Title'),
        ];
    }
}
