<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Invitation */

$verifyLink = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['site/signup', 'token' => $model->userInvitation->invitation_token]);
$albumLink = Yii::$app->urlManager->createAbsoluteUrl(['album/view', 'slug' => $model->album->slug]);
?>
<div class="verify-email">
    <p>Hello,</p>

    <p><?= $model->userInvitation->user->username;?> has shared album <?= Html::a(Html::encode($model->album->name), $albumLink);?> with you.</p>

	<p>Register yourself with your email on following link to access the shared album.</p>

    <p><?= Html::a('Accept Invitation', $verifyLink) ?></p>
</div>
