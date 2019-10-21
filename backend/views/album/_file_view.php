<?php
use yii\helpers\Html;
use common\models\Media;
						
if($model->isImage()){
	$preview = Yii::$app->urlManager->baseUrl.'/uploads/'.$model->file_name;
}else{
	$preview = Media::getDummyImage();
}
?>
<div class="file-container">
	<div class="file-image-container">
		<img src="<?= $preview?>" alt="<?= $model->alt?>" title="<?= $model->alt?>" class="img-responsive">
	</div>
	<span class="file-name" title="<?= Html::encode($model->alt)?>"><?= Html::encode($model->alt)?></span>
	<span class="users-list-date">On <?= date('d M, Y', $model->created_at)?></span>
	<span class="users-list-date">Size: <?= $model->fileSize?></span>
	<div class="action-buttons">
		<?php if($model->isImage()){?>
			<?= Html::a('<i class="fa fa-image"></i>', ['album/set-cover', 'album' => $model->album->slug, 'image' => $model->slug], ['class' => ($model->albumCover?'btn btn-success':'btn btn-info'), 'data' => ['method' => 'post', 'confirm' => 'Do you really want to set it as cover image?']]);?>
		<?php }?>
		<?= Html::a('<i class="fa fa-trash"></i>', ['album/delete-file', 'album' => $model->album->slug, 'file' => $model->slug], ['class' => 'btn btn-danger', 'data' => ['method' => 'post', 'confirm' => 'Do you really want to delete it?']]);?>
	</div>
</div>