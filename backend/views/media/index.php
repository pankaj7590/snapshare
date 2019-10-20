<?php

use yii\helpers\Html;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\MediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Upload Media', ['upload', 'slug' => $albumModel->slug], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
		<?= ListView::widget([
			'dataProvider' => $dataProvider,
			'itemOptions' => ['class' => 'item col-md-2'],
			'itemView' => function ($model, $key, $index, $widget) {
				if($model->isImage()){
					$preview = Yii::$app->urlManager->baseUrl.'/uploads/'.$model->file_name;
				}else{
					$preview = Media::getDummyImage();
				}
				return Html::a('<img src="'.$preview.'" alt="'.$model->alt.'" class="img-responsive">'.
						Html::encode($model->name)
						.'<span class="users-list-date text-center">'.date('d M, Y').'</span>', Yii::$app->urlManager->createAbsoluteUrl(['album/view', 'slug' => $model->slug]), ['class' => 'users-list-name']);
			},
		]) ?>
    </div>
</div>
