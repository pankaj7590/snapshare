<?php
namespace console\controllers;

use yii\console\Controller;

class BackupController extends Controller{
	public function actionIndex(){
		/** @var \demi\backup\Component $backup */
        $backup = \Yii::$app->backup;        
        $file = $backup->create();
        $this->stdout('Backup file created: ' . $file . PHP_EOL, \yii\helpers\Console::FG_GREEN);
	}
}
?>