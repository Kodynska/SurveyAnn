<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rates".
 *
 * @property int $id Record ID
 * @property string $text Text
 * @property int $survey_id Survey ID
 */
class Rates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'survey_id'], 'required'],
            [['survey_id'], 'integer'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Record ID'),
            'text' => Yii::t('app', 'Text'),
            'survey_id' => Yii::t('app', 'Survey ID'),
        ];
    }
}
