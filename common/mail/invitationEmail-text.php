<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Invitation */

$verifyLink = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['site/signup', 'token' => $model->userInvitation->invitation_token]);
$albumLink = Yii::$app->urlManager->createAbsoluteUrl(['album/view', 'slug' => $model->album->slug]);
?>
Hello,

<?= $model->userInvitation->user->username?> has shared album <?= $model->album->name?> with you.

Register yourself with your email on following link to access the shared album.</p>

<?= $verifyLink ?>