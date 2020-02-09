<?php
use common\models\enums\DirectoryTypes;

$this->registerCss("
	.profile-pic{
		width:50px;
		height:50px;
		background-size:cover;
		background-repeat:no-repeat;
	}
	.user-panel>.info {
		padding: 15px 5px 5px 15px;
	}
");
?>
<aside class="main-sidebar">

    <section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<?php if(Yii::$app->user->identity->profilePic){?>
					<div style="background-image:url('<?= DirectoryTypes::getUploadsDirectory(false, true).'/'.Yii::$app->user->identity->profilePic->file_name?>')" class="img-circle profile-pic"></div>
				<?php }?>
			</div>
			<div class="pull-left info">
				<p><?= Yii::$app->user->identity->username;?></p>
			</div>
		</div>
	  
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Member since '.date('M. Y', Yii::$app->user->identity->created_at), 'options' => ['class' => 'header']],
                    ['label' => 'Users', 'icon' => 'users', 'url' => ['/user/index']],
                    ['label' => 'My Albums', 'icon' => 'camera', 'url' => ['/album/index']],
                    ['label' => 'Shared With Me', 'icon' => 'camera', 'url' => ['/shared/index']],
                    [
                        'label' => 'User Management',
                        'icon' => 'cogs',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Assignments', 'icon' => 'check', 'url' => ['/admin/assignment'],],
                            ['label' => 'Routes', 'icon' => 'random', 'url' => ['/admin/route'],],
                            ['label' => 'Roles', 'icon' => 'vcard', 'url' => ['/admin/role'],],
                        ],
                    ],
                    ['label' => 'Backups', 'icon' => 'download', 'url' => ['/site/backup']],
                    ['label' => 'Change Profile Pic', 'icon' => 'user', 'url' => ['/site/change-profile-pic']],
                    ['label' => 'Change Password', 'icon' => 'asterisk', 'url' => ['/site/change-password']],
                    ['label' => 'Logout', 'icon' => 'sign-out', 'url' => ['/site/logout'], 'template' => '<a href="{url}" data-method="post" data-confirm="Do you want to logout?">{icon} {label}</a>'],
                ],
            ]
        ) ?>

    </section>

</aside>
