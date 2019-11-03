<?php

namespace app\base;

use app\helpers\AccessHelper;
use app\models\base\DistributorActiveRecord;
use app\models\Distributor;
use app\models\User;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class WebController extends Controller
{
    /**
     * @var string Model of permission calss to generate default access rules
     */
    protected $permissionModel;
    /**
     * @var ActiveRecord| DistributorActiveRecord
     */
    protected $modelClass;

    protected $searchModelClass;


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET', 'POST'],
                    'create' => ['GET', 'POST'],
                    'update' => ['GET', 'POST', 'PUT'],
                    'delete' => ['POST', 'DELETE'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => $this->accessRules(),
            ],
        ];
    }

    /**
     * @return array Returns default access rules for $permissionModel
     * with full access for [AccessHelper::PERM_MANAGE_ACCESS] permission
     */
    public function accessRules()
    {
        return [
            [
                'allow' => true,
                'roles' => [AccessHelper::PERM_EVERYTHING],
            ],
            [
                'allow' => true,
                'actions' => ['index'],
                'roles' => ['index' . $this->permissionModel],
            ],
            [
                'allow' => true,
                'actions' => ['view'],
                'roles' => ['view' . $this->permissionModel],
            ],
            [
                'allow' => true,
                'actions' => ['create'],
                'roles' => ['create' . $this->permissionModel],
            ],
            [
                'allow' => true,
                'actions' => ['update'],
                'roles' => ['update' . $this->permissionModel],
            ],
            [
                'allow' => true,
                'actions' => ['delete'],
                'roles' => ['delete' . $this->permissionModel],
            ],
        ];
    }

    /**
     * Displays a single Agent model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->viewDetail($id, 'view');
    }

    public function actionIndex()
    {
        $searchModelClass = $this->searchModelClass;

        $searchModel = new $searchModelClass ();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filters' => $filters = $this->filters(),
        ]);
    }

    /**
     * Updates an existing Branch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        return $this->viewDetail($id, 'edit');
    }


    /**
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can(AccessHelper::PERM_SEE_ALL_DISTRIBUTORS)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            throw new ForbiddenHttpException('The requested page forbidden.');
        }
    }

    /**
     * Deletes an existing ActiveRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * @param int $id
     * @param string $mode
     * @return string
     */
    protected function viewDetail($id, $mode)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        // return messages on update of record
        if ($model->load($post) && $model->save()) {
            $this->setFlashUpdated();
        }

        if(!empty($model->errors))
            Yii::error($model->errors, 'updated');

        if (Yii::$app->request->isAjax && isset($post['kvdelete'])) {
            $model->delete();
            $this->getMessageDeleted();

            return null;
        }

        return $this->render('view', [
            'model' => $model,
            'mode' => $mode,
            'tabs' => $this->tabs($model),
            'filters' => $this->filters()
        ]);
    }

    /**
     * @param int $id
     * @return ActiveRecord | DistributorActiveRecord
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $modelClass = $this->modelClass;

        if (($model = $modelClass::findOne(['id' => $id])) !== null) {

            if (\Yii::$app->user->can(AccessHelper::PERM_SEE_ALL_DISTRIBUTORS)) {
                return $model;
            } else {

                if (User::accessDistributor($model->distributor_id)) {
                    return $model;
                } else {
                    throw new ForbiddenHttpException('The requested page forbidden.');
                }
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function setFlashUpdated()
    {
        Yii::$app->session->setFlash('kv-detail-success',
            Yii::t('app', '{0} was successfully updated.',
                [$this->modelClass::modelTitle()]));
        return;
    }

    protected function getMessageDeleted()
    {
        $link = Html::a(
            '<i class="glyphicon glyphicon-hand-right"></i> ' . Yii::t('app', 'Click here'),
            ['/' . \Yii::$app->controller->getUniqueId()],
            ['class' => 'btn btn-sm btn-info']);

        return Json::encode([
            'success' => true,
            'messages' => [
                'kv-detail-info' =>
                    Yii::t(
                        'app',
                        'The {0} was successfully deleted. {1} to proceed.',
                        [$this->modelClass::modelTitle(), $link])

            ]
        ]);

    }

    /**
     * @return array
     */
    protected function filters()
    {
        $filters = [];

        $modelClass = $this->modelClass;
        if (is_subclass_of($modelClass::className(), DistributorActiveRecord::class)){
            $filters['distributor'] = Distributor::findByUser()
                ->orderBy('name')->asArray()->all();
        }
        return $filters;
    }

    /**
     * @param $model
     * @return array
     */
    protected function tabs($model)
    {
        return [];
    }

    /**
     * @param null $model
     * @param null $search
     * @param null $id
     * @return array
     */
    public function actionList($model = null, $search = null, $id = null)
    {
        /**
         * @var $model DistributorActiveRecord
         */
        $model = "\\app\\models\\$model";

        $query = $model::find();

        if(is_subclass_of($model::className(), DistributorActiveRecord::class))
            $query = $model::findByUser();


        $out = [['id' => '', 'text' => '']];

        if ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => $model::findOne(['id' => $id])->name];
           return $out;
       }

        $query->select(['*','id', 'text' => 'name'])
            ->andWhere(['like', 'name', $search ?? ''])
            ->orderBy('name')
//            ->limit(1000)
            ->asArray();

        return $this->asJson($query->all());
    }
}