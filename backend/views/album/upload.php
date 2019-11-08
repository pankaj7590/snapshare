<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

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

			<?= $form->field($model, 'temp_files[]')->widget(FileInput::classname(), [
				'options' => ['multiple' => 'true'],
			]);?>
			
			<?= $form->field($model, 'do_compress')->checkbox(['checked' => 'checked']);?>
			
			<?= $form->field($model, 'compress_quality')->textInput(['value' => Yii::$app->params['default_compress_quality']]);?>

		</div>
		<div class="box-footer">
			<?= Html::submitButton('Upload', ['class' => 'btn btn-success btn-flat']) ?>
		</div>
		<?php ActiveForm::end(); ?>
	</div>

</div>