<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
		<img src="<?= Yii::$app->urlManagerBackend->baseUrl;?>/images/snapshare-logo-200.png"/>
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully registered yourself on <?= $this->title;?>.</p>

        <p><a class="btn btn-lg btn-success" href="<?= Yii::$app->urlManagerBackend->createAbsoluteUrl(['site/index'])?>">Get started with <?= $this->title;?></a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2 class="text-warning">Create Albums</h2>

                <p>Create albums to organize your files. You can share the album with your contact at ease. You can added any type of file in an album. You can set an image file as album cover. You can generate a sharable link of an album if you do not want invited user to register on the website.</p>

                <p><a class="btn btn-default" href="<?= Yii::$app->urlManagerBackend->createAbsoluteUrl(['album/index'])?>">View My Albums</a></p>
            </div>
            <div class="col-lg-4">
                <h2 class="text-info">Add Files</h2>

                <p>Upload any file to the albums. While uploading images, <strong>.jpeg, .jpg</strong> files will automatically compressed to <strong>70%</strong>. You may choose the compression percentage or not to compress images at all while uploading images. Simply <strong>drag'n'drop</strong> the files while uploading, choose whether to compress or not, set compression percentage and upload files.</p>
				
            </div>
            <div class="col-lg-4">
                <h2 class="text-success">Share Albums</h2>

                <p>Share the created albums with your contacts. Simply put their email address or choose from email addresses in your existing contact. A link will be sent to the email address. Once the invited user has accepted the invitation and registered on the website, the shared albums will be available for the user to view and download images.</p>

            </div>
        </div>

    </div>
</div>
