<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use common\models\Media;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Albums';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-index box box-default">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a('Create Album', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
		<?= ListView::widget([
			'dataProvider' => $dataProvider,
			'itemOptions' => ['class' => 'item col-md-2'],
			'itemView' => function ($model, $key, $index, $widget) {
				$coverImage = ($model->coverImage?$model->coverImage:Media::getDummyImage());
				return Html::a('<img src="'.$coverImage.'" alt="User Image" class="img-responsive">'.
						Html::encode($model->name)
						.'<span class="users-list-date text-center">'.date('d M, Y').'</span>', Yii::$app->urlManager->createAbsoluteUrl(['album/view', 'slug' => $model->slug]), ['class' => 'users-list-name']);
			},
		]) ?>
    </div>
    <?php Pjax::end(); ?>
</div>
