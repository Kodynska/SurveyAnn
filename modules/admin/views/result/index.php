<?php
/**
 * Created by PhpStorm.
 * User: kodynska
 * Date: 31.10.2019
 * Time: 21:21
 *
 * <?php
 *
 * /* @var $this yii\web\View
 */

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'created_at',
                    'filter' => kartik\date\DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'date_from',
                        'attribute2' => 'date_to',
                        'type' => kartik\date\DatePicker::TYPE_RANGE,
                        'separator' => '-',
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'weekStart' => 1,
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ],
                    ]),
                    'format' => ['date', 'YYYY-MM-dd'],
                ],
                'email',
                'name',
                'comment',
                'rate',
                'user_id',
            ],
        ]); ?>
</div>
