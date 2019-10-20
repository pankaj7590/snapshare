<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Album;

/* @var $this yii\web\View */
/* @var $model common\models\Album */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-view box box-primary">
    <div class="box-header">
        <?= Html::a('Update', ['update', 'slug' => $model->slug], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Media', ['media', 'slug' => $model->slug], ['class' => 'btn btn-success btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'slug' => $model->slug], [
            'class' => 'btn btn-danger btn-flat pull-right',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
				[
					'attribute' => 'is_link_shared',
					'value' => function($model){
						return ($model->is_link_shared?'Yes':'No');
					},
				],
				[
					'attribute' => 'status',
					'value' => function($model){
						return Album::$statuses[$model->status];
					},
				],
				[
					'attribute' => 'created_by',
					'value' => function($model){
						return $model->createdBy->username;
					},
				],
				[
					'attribute' => 'updated_by',
					'value' => function($model){
						return $model->updatedBy->username;
					},
				],
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>
