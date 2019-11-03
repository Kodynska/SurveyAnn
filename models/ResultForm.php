<?php
/**
 * Created by PhpStorm.
 * User: kodynska
 * Date: 02.11.2019
 * Time: 17:09
 */

namespace app\models;


use Yii;
use yii\base\Model;
use app\models\Result;
use app\models\Answers;
use app\models\Rates;
use app\models\Survey;


class ResultForm extends Result
{

    public $answers;
    public $name;
    public $email;
    public $created_at;
    public $rate;
    /**
     * @param $data
     * @param null $formName
     * @return bool
     */
    public function load($data, $formName = null)

    {

        if (!parent::load($data, $formName)) {

            return false;

        }


        return Model::loadMultiple($this->answers, $data, $formName);

    }


}