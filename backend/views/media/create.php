<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Media */

$this->title = 'Create Media';
$this->params['breadcrumbs'][] = ['label' => 'Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
