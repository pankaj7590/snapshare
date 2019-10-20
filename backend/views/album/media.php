<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use common\models\Media;
/* @var $this yii\web\View */
/* @var $searchModel common\models\MediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Upload Media', ['upload-files', 'slug' => $model->slug], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
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