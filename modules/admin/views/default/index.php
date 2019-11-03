<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use lslsoft\poll\Poll;
use kartik\grid\GridView;

$this->title = 'ADMIN';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>

        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
    </p>
</div>
