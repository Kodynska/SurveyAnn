<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "result".
 *
 * @property int $id Record ID
 * @property string $email Email
 * @property string $name Name
 * @property string $comment Comment
 * @property int $survey_id Survey ID
 * @property int $user_id User ID
 * @property int $rate Rate
 * @property string $created_at
 * @property string $updated_at
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'name', 'comment', 'rate'], 'required'],
            [['survey_id', 'user_id', 'rate'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['email', 'name'], 'string', 'max' => 255],
            ['email', 'email'],
            [['comment'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function(){ return date('Y-m-d');},
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Record ID'),
            'email' => Yii::t('app', 'Email'),
            'name' => Yii::t('app', 'Name'),
            'comment' => Yii::t('app', 'Comment'),
            'survey_id' => Yii::t('app', 'Survey ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'rate' => Yii::t('app', 'Rate'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
