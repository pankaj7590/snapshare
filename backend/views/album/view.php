<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Album;
use yii\widgets\ListView;
use common\models\Media;

/* @var $this yii\web\View */
/* @var $model common\models\Album */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
	<div class="row">
		<div class="col-md-3">
			<div class="album-view box box-primary">
				<div class="box-header">
					<?= Html::a('Update', ['update', 'slug' => $model->slug], ['class' => 'btn btn-primary btn-flat']) ?>
					<?= Html::a('<i class="fa fa-plus"></i>', ['upload-files', 'slug' => $model->slug], ['class' => 'btn btn-success btn-flat', 'title' => 'Upload media']) ?>
					<?= Html::a('<i class="fa fa-share"></i>', ['share', 'slug' => $model->slug], ['class' => 'btn btn-warning btn-flat', 'title' => 'Share album']) ?>
					<?= Html::a('<i class="fa fa-link"></i>', ['link-share', 'slug' => $model->slug], ['class' => 'btn btn-default btn-flat', 'title' => 'Share album']) ?>
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
		</div>
		<div class="col-md-9">
			<div class="media-index box box-primary">
				<div class="box-body table-responsive">
					<div class="container-fluid">
						<div class="row">
							<?= ListView::widget([
								'dataProvider' => $dataProvider,
								'itemOptions' => ['class' => 'item col-md-2'],
								'itemView' => function ($model, $key, $index, $widget) {
									return Html::a($this->render('_file_view', ['model' => $model]), null, ['class' => 'users-list-name']);
								},
							]) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
$this->registerCss("
.file-image-container{
	height:100px;
	overflow:hidden;
}
.file-container{
    margin-bottom: 20px;
    border: 2px solid #000;
    border-radius: 10px;
    padding: 10px;
}
span.file-name {
    display: block;
    text-overflow: ellipsis;
    overflow: hidden;
}
.action-buttons{
	border-top:1px solid #000;
	margin-top:5px;
	padding-top:5px;
}
");
?>