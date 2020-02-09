<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\enums\DirectoryTypes;

$this->title = "Change Profile Pic";
?>
<div class="row">
	<div class="col-md-4">
		<div class="box box-success">
			<div class="box-body">
				<?php $form = ActiveForm::begin(['id' => 'change-profile-pic-form']); ?>
					<?php if(Yii::$app->user->identity->profilePic){?>
						<img src="<?= DirectoryTypes::getUploadsDirectory(false, true).'/'.Yii::$app->user->identity->profilePic->file_name?>" width="100%" class="margin-bottom img-responsive"/>
						<?= Html::a('Remove Profile Pic', ['site/remove-profile-pic'], ['class' => 'btn btn-danger btn-block btn-flat margin-bottom', 'data' => ['method' => 'post', 'confirm' => 'Are you sure you want to delete your profile picture?']]); ?>
					<?php }else{?>
						<?= $form->field($model, 'temp_pic')->fileInput() ?>
						<?= Html::submitButton('Update', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'change-profile-pic-button']) ?>
					<?php }?>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>