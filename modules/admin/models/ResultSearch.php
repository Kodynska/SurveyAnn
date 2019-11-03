<?php
/**
 * Created by PhpStorm.
 * User: kodynska
 * Date: 03.11.2019
 * Time: 14:52
 */

namespace app\modules\admin\models;


use app\models\Result;
use Yii;
use yii\data\ActiveDataProvider;

class ResultSearch extends Result
{
    public $date_from;
    public $date_to;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['survey_id', 'user_id', 'rate'], 'integer'],
            [['email', 'name'], 'string'],
            [[ 'created_at', 'updated_at'], 'safe'],
            [['comment'], 'string'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }



    public function search($params)
    {
        $query = self::find();



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->setSort([
            'attributes' => [
                'survey_id', 'user_id', 'rate', 'created_at', 'updated_at','email', 'name'  , 'comment']
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }


        $query->andFilterWhere(['like', 'email', $this->email]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'comment', $this->comment]);
        $query->andFilterWhere([ self::tableName() . '.rate' => $this->rate]);
        $query->andFilterWhere([ self::tableName() . '.user_id' => $this->user_id]);


        $query
            ->andFilterWhere(['>=', 'created_at', $this->date_from ])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ]);

        return $dataProvider;
    }


}