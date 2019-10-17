<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Media */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="media-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'file_type')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'file_size')->textInput() ?>

        <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'is_cover')->textInput() ?>

        <?= $form->field($model, 'link_shared')->textInput() ?>

        <?= $form->field($model, 'status')->textInput() ?>

        <?= $form->field($model, 'created_by')->textInput() ?>

        <?= $form->field($model, 'updated_by')->textInput() ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
