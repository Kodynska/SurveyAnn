<?php
/**
 * Created by PhpStorm.
 * User: kodynska
 * Date: 03.11.2019
 * Time: 14:47
 */

namespace app\modules\admin\controllers;


use app\modules\admin\models\ResultSearch;
use Yii;
use yii\web\Controller;


class ResultController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {

        $searchModel = new ResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

}