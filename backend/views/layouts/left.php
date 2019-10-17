<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Member since '.date('M. Y', Yii::$app->user->identity->created_at), 'options' => ['class' => 'header']],
                    ['label' => 'Users', 'icon' => 'users', 'url' => ['user/index']],
                    ['label' => 'Albums', 'icon' => 'camera', 'url' => ['album/index']],
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
                    ['label' => 'Change Password', 'icon' => 'asterisk', 'url' => ['site/change-password']],
                    ['label' => 'Logout', 'icon' => 'sign-out', 'url' => ['site/logout'], 'template' => '<a href="{url}" data-method="post" data-confirm="Do you want to logout?">{icon} {label}</a>'],
                ],
            ]
        ) ?>

    </section>

</aside>
