<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About '.Yii::$app->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::$app->name;?> is a platform for sharing files privately.</p>
	<p>It is as simple as any other platform.</p>
	<ol>
		<li>Just register yourself,</li>
		<li>Create an album,</li>
		<li>Add files in it to share,</li>
		<li>Enter email addresses of users to share the album with.</li>
	</ol>
	<p>That's it.</p>
</div>
