<?php
/* @var $this yii\web\View */


use kartik\range\RangeInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>
<h1>Survey</h1>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/js/all.js">
<?php if (Yii::$app->session->hasFlash('pollFormSubmitted')): ?>


    <div class="alert alert-success">
        Thank you for rating us. We will respond to you as soon as possible.
    </div>
<?php else: ?>
    <?php Pjax::begin() ?>
    <?php $form = ActiveForm::begin() ?>

    <?= '<h3 class="control-label">On a Scale of 1 to 10, How Would You Rate Our Company?</h3>'; ?>


    <?= $form->field($model, 'rate')->widget(RangeInput::classname(), [
        'options' => ['placeholder' => 'Rate (0 - 10)...'],
        'size' => 'lg',
        'html5Container' => ['style' => 'width:750px'],
        'html5Options' => ['min' => 0, 'max' => 10],
        'addon' => ['append' => ['content' => '<i class="fas fa-star"></i>']]
    ])->label(false);?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => $user_id])->label(false);?>
    <?= $form->field($model, 'name'); ?>
    <?= $form->field($model, 'email'); ?>
    <?= $form->field($model, 'comment')->textarea(); ?>

    <div class="form-group">
        <div class="col-lg col-lg-11">
            <?= Html::submitButton(Yii::t('app', 'Save'),
                ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end() ?>
    <?php Pjax::end(); ?>
<?php endif; ?>
