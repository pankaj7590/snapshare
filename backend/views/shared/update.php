<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Shared */

$this->title = 'Update Shared: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Shareds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shared-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
