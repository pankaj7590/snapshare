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
    <div class="box-body table-responsive">
		<?= ListView::widget([
			'dataProvider' => $dataProvider,
			'itemOptions' => ['class' => 'item col-md-3'],
			'itemView' => function ($model, $key, $index, $widget) {
				return Html::a($this->render('_album_view', ['model' => $model]), Yii::$app->urlManager->createAbsoluteUrl(['album/view', 'slug' => $model->slug]), ['class' => 'users-list-name']);
			},
		]) ?>
    </div>
    <?php Pjax::end(); ?>
</div>
<?php
$this->registerCss("
.file-image-container{
	height:150px;
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