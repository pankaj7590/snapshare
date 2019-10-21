<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Album;

/* @var $this yii\web\View */
/* @var $model common\models\Album */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="album-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->errorSummary($model); ?>
		
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'is_link_shared')->checkbox() ?>

        <?= $form->field($model, 'status')->dropdownlist(Album::$statuses) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
