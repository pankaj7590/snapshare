<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Album;
use yii\widgets\ListView;
use common\models\Media;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Album */

$this->title = $model->album->name;
$this->params['breadcrumbs'][] = ['label' => 'Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
	<div class="row">
		<div class="col-md-3">
			<div class="album-view box box-primary">
				<div class="box-header">
					<?= Html::a('<i class="fa fa-download"></i>', ['download', 'slug' => $model->album->slug], ['class' => 'btn btn-info btn-flat', 'title' => 'Download album']) ?>
				</div>
				<div class="box-body table-responsive no-padding">
					<?= DetailView::widget([
						'model' => $model,
						'attributes' => [
							[
								'attribute' => 'name',
								'value' => function($model){
									return $model->album->name;
								},
							],
							[
								'attribute' => 'is_link_shared',
								'value' => function($model){
									return ($model->album->is_link_shared?'Yes':'No');
								},
							],
							[
								'attribute' => 'status',
								'value' => function($model){
									return Album::$statuses[$model->album->status];
								},
							],
							[
								'attribute' => 'created_by',
								'value' => function($model){
									return $model->album->createdBy->username;
								},
							],
							[
								'attribute' => 'updated_by',
								'value' => function($model){
									return $model->album->updatedBy->username;
								},
							],
							[
								'attribute' => 'created_at',
								'format' => 'datetime',
								'value' => function($model){
									return $model->album->created_at;
								},
							],
							[
								'attribute' => 'updated_at',
								'format' => 'datetime',
								'value' => function($model){
									return $model->album->updated_at;
								},
							],
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
								'id' => 'lightGallery',
								'layout' => '{items}',
								'dataProvider' => $dataProvider,
								'itemOptions' => function($model, $key, $index, $widget){
									if($model->isImage()){
										$preview = Yii::$app->urlManager->baseUrl.'/uploads/'.$model->file_name;
									}else{
										$preview = Media::getDummyImage();
									}
									return [
										'class' => 'col-md-2', 
										'data-src' => $preview,
									];
								},
								'itemView' => function ($model, $key, $index, $widget) {
									return $this->render('_file_view_shared', ['model' => $model]);
								},
							]) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/js/lightgallery/css/lightgallery.min.css');
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/lightgallery/js/lightgallery-all.min.js', ['depends' => \yii\web\JqueryAsset::className()]);
$this->registerJs("
	$('#lightGallery').lightGallery();
", View::POS_READY);
?>
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