<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property int $id Record ID
 * @property string $title Title
 * @property int $result_id Question ID
 * @property int $rates_id Question ID
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'result_id', 'rates_id'], 'required'],
            [['result_id', 'rates_id'], 'integer'],
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
            'result_id' => Yii::t('app', 'Result ID'),
            'rates_id' => $this->rusult->text
        ];
    }
}
