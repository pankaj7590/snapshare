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
</div>