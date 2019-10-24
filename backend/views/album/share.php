<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Media */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Share Album';
$this->params['breadcrumbs'][] = ['label' => 'Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-create">

    <div class="media-form box box-primary">
		<?php $form = ActiveForm::begin(); ?>
		<div class="box-body table-responsive">

			<?= $form->field($model, 'temp_emails[]')->widget(Select2::classname(), [
				'data' => ArrayHelper::map($dataProvider->models, 'id', 'email'),
				'options' => ['placeholder' => 'Select or enter new email ...', 'multiple' => true],
				'pluginOptions' => [
					'tags' => true,
					'tokenSeparators' => [',', ' '],
				],
			])->label('Emails');?>

		</div>
		<div class="box-footer">
			<?= Html::submitButton('Send Invitations', ['class' => 'btn btn-success btn-flat']) ?>
		</div>
		<?php ActiveForm::end(); ?>
	</div>

</div>