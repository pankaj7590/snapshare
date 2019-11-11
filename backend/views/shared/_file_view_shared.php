<?php
use yii\helpers\Html;
use common\models\Media;
						
if($model->isImage()){
	$preview = Yii::$app->urlManager->baseUrl.'/uploads/'.$model->file_name;
}else{
	$preview = Media::getDummyImage();
}
?>
<div class="users-list-name">
	<div class="file-container">
		<div class="file-image-container">
			<img src="<?= $preview?>" alt="<?= $model->alt?>" title="<?= $model->alt?>" class="img-responsive">
		</div>
		<span class="file-name" title="<?= Html::encode($model->alt)?>"><?= Html::encode($model->alt)?></span>
		<span class="users-list-date">On <?= date('d M, Y', $model->created_at)?></span>
		<span class="users-list-date">Size: <?= $model->fileSize?></span>
	</div>
</div>