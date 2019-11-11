<?php
return [
	'name' => 'SnapShare',
	'timezone' => 'Asia/Kolkata',
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
		'backup' => [
			'class' => 'common\components\BackupComponent',
			// The directory for storing backups files
			'backupsFolder' => dirname(dirname(__DIR__)) . '/backend/web/backups', // <project-root>/backups
			// Directories that will be added to backup
			'directories' => [
				'uploads' => '@backend/web/uploads',
			],
			'dbhost' => '35.202.63.29',
		],
    ],
];
