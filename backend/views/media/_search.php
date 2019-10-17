<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MediaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="media-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'file_name') ?>

    <?= $form->field($model, 'file_type') ?>

    <?= $form->field($model, 'file_size') ?>

    <?= $form->field($model, 'alt') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'is_cover') ?>

    <?php // echo $form->field($model, 'link_shared') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
