<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

/**
 * Default controller for the `admin` module
*/
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     *  @var $dataProvider /Applications/MAMP/htdocs/basic/vendor/yiisoft/yii2/data/ActiveDataProvider.php
     * @return string
     */
    public function actionIndex()
    {
        /**
         * Renders the index view for the module
         *  @var $dataProvider /Applications/MAMP/htdocs/basic/vendor/yiisoft/yii2/data/ActiveDataProvider.php
         * @return string
         */
        return $this->render('index', [
//             'dataProvider' => $dataProvider,
        ]);
    }
}
