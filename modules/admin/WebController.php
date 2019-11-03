<?php
/**
 * Created by PhpStorm.
 * User: dimon
 * Date: 14.05.17
 * Time: 12:42
 */

namespace app\modules\globalCatalogs;


use app\helpers\ClassHelper;
use Yii;
use yii\db\ActiveRecord;

class WebController extends \app\base\WebController
{
    /**
     * Creates a new ActiveRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /**
         * @var ActiveRecord $model
         */
        $modelClass = $this->modelClass;
        $model = new $modelClass();

        $request = Yii::$app->request;
        if($request->isGet){
            $model->load(Yii::$app->request->get(), '');
        }elseif ($model->load(Yii::$app->request->post()) ) {
            $model->is_deleted = 0;
            if($model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('view', [
            'model' => $model,
            'mode' => 'edit',
            'id' => $model->id,
            'filters' => $this->filters(),
            'tabs' => $this->tabs($model),
        ]);
    }


}