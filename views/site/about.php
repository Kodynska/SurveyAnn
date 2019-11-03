<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use lslsoft\poll\Poll;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Poll::widget([
                'idPoll' => 3,
            ]
        ); ?>

        This is the About page. You may modify the following file to customize its content:
    </p>

</div>
