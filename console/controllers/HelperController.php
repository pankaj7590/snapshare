<?php
namespace console\controllers;

use yii\console\Controller;

class HelperController extends Controller{
	
	public function actionCleanAlbumDownloads()
	{
		$files=\yii\helpers\FileHelper::findFiles(\Yii::getAlias('@backend/web/backups'));
		if (isset($files[0])){
			rsort($files);
			foreach($files as $index => $file){
				$name = basename($file);
				$filePath = Url::base().'/../backups/'.$name;
				unlink($filePath);
			}
		}
	}
}
?>