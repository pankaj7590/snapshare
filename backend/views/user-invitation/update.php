<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserInvitation */

$this->title = 'Update User Invitation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Invitations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-invitation-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
