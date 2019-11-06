<?php
use yii\helpers\Html;
use common\models\Media;

$albumModel = $model->album;
if($albumModel->coverImage){
	$coverImage = Yii::$app->urlManager->baseUrl.'/uploads/'.$albumModel->coverImage->file_name;
}else{
	$coverImage = Media::getDummyImage();
}
?>
<div class="file-container">
	<div class="file-image-container">
		<img src="<?= $coverImage?>" alt="<?= $albumModel->name?>" title="<?= $albumModel->name?>" class="img-responsive" style="width:100%">
	</div>
	<span class="file-name" title="<?= Html::encode($albumModel->name)?>"><?= Html::encode($albumModel->name)?></span>
	<span class="users-list-date">Created on <?= date('d M, Y', $albumModel->created_at)?></span>
	<span class="users-list-date">Size: <?= $albumModel->albumSize?></span>
	<div class="action-buttons">
		<?= Html::a('<i class="fa fa-plus"></i>', ['upload-files', 'slug' => $albumModel->slug], ['class' => 'btn btn-success btn-flat', 'title' => 'Upload media']) ?>
		<?= Html::a('<i class="fa fa-share"></i>', ['album/share', 'slug' => $albumModel->slug], ['class' => 'btn btn-warning']);?>
		<?= Html::a('<i class="fa fa-link"></i>', ['album/link-share', 'slug' => $albumModel->slug], ['class' => 'btn btn-default']);?>
		<?= Html::a('<i class="fa fa-trash"></i>', ['album/delete', 'slug' => $albumModel->slug], ['class' => 'btn btn-danger', 'data' => ['method' => 'post', 'confirm' => 'Do you really want to delete it?']]);?>
	</div>
</div>