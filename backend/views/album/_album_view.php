<?php
use yii\helpers\Html;
use common\models\Media;


if($model->coverImage){
	$coverImage = Yii::$app->urlManager->baseUrl.'/uploads/'.$model->coverImage->file_name;
}else{
	$coverImage = Media::getDummyImage();
}
?>
<div class="file-container">
	<div class="file-image-container">
		<img src="<?= $coverImage?>" alt="<?= $model->name?>" title="<?= $model->name?>" class="img-responsive">
	</div>
	<span class="file-name" title="<?= Html::encode($model->name)?>"><?= Html::encode($model->name)?></span>
	<span class="users-list-date">Created on <?= date('d M, Y', $model->created_at)?></span>
	<span class="users-list-date">Size: <?= $model->albumSize?></span>
	<div class="action-buttons">
		<?= Html::a('<i class="fa fa-share"></i>', ['album/share', 'slug' => $model->slug], ['class' => 'btn btn-warning']);?>
		<?= Html::a('<i class="fa fa-link"></i>', ['album/link-share', 'slug' => $model->slug], ['class' => 'btn btn-default']);?>
		<?= Html::a('<i class="fa fa-trash"></i>', ['album/delete', 'slug' => $model->slug], ['class' => 'btn btn-danger', 'data' => ['method' => 'post', 'confirm' => 'Do you really want to delete it?']]);?>
	</div>
</div>