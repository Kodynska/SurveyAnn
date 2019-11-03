<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Survey]].
 *
 * @see Survey
 */
class SurveyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Survey[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Survey|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
