<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserContact */

$this->title = 'Create User Contact';
$this->params['breadcrumbs'][] = ['label' => 'User Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-contact-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
