<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = "Change Password";
?>
<div class="row">
	<div class="col-md-4">
		<div class="box box-success">
			<div class="box-body">
				<?php $form = ActiveForm::begin(['id' => 'change-password-form']); ?>
					<?= $form->field($model, 'old_password')->passwordInput() ?>
					<?= $form->field($model, 'password')->passwordInput() ?>
					<?= $form->field($model, 're_password')->passwordInput() ?>
					<?= Html::submitButton('Change Password', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>