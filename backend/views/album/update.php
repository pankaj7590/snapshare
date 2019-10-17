<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Album */

$this->title = 'Update Album: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="album-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
