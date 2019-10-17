<?php
return [
	'name' => 'SnapShare',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'mainLayout' => '@app/views/layouts/main.php',
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
    ],
];
