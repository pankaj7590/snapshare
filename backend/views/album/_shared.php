<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Media;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shared-index box box-success">
    <?php Pjax::begin(); ?>
		<div class="box-body table-responsive">
			<?= GridView::widget([
           'dataProvider' => $dataProvider,
           'filterModel' => $searchModel,
           'layout' => "{items}\n{summary}\n{pager}",
           'columns' => [
               ['class' => 'yii\grid\SerialColumn'],
				[
					'attribute' => 'shared_with',
					'filter' => false,
					'value' => function($model){
						return ($model->sharedWith->username);
					},
				],
				[
					'attribute' => 'created_at',
					'format' => 'datetime',
					'filter' => false,
					'label' => 'Shared on',
					'value' => function($model){
						return ($model->created_at);
					},
				],
				[
					'class' => 'yii\grid\ActionColumn',
					'template' => '{delete}',
					'buttons' => [
						'delete' => function($url, $model, $key){
							return Html::a('<i class="glyphicon glyphicon-trash"></i>', ['remove-shared', 'album' => $model->album->slug, 'with' => $model->sharedWith->username], ['data' => [
								'method' => 'post',
								'confirm' => 'Are you sure you want to remove the user from shared list?',
							]]);
						}
					]
				],
			],
       ]); ?>
		</div>
    <?php Pjax::end(); ?>
</div>