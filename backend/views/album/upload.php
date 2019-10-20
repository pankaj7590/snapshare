<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Media */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Upload Media';
$this->params['breadcrumbs'][] = ['label' => 'Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-create">

    <div class="media-form box box-primary">
		<?php $form = ActiveForm::begin(); ?>
		<div class="box-body table-responsive">

			<?= $form->field($model, 'temp_files[]')->fileInput(['multiple' => true]) ?>

		</div>
		<div class="box-footer">
			<?= Html::submitButton('Upload', ['class' => 'btn btn-success btn-flat']) ?>
		</div>
		<?php ActiveForm::end(); ?>
	</div>

</div>