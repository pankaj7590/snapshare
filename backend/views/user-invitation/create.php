<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserInvitation */

$this->title = 'Create User Invitation';
$this->params['breadcrumbs'][] = ['label' => 'User Invitations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-invitation-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
