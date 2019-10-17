<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Shared */

$this->title = 'Create Shared';
$this->params['breadcrumbs'][] = ['label' => 'Shareds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shared-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
