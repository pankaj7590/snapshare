<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserContact */

$this->title = 'Update User Contact: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-contact-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
