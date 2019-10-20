<?php
namespace common\models\enums;

use Yii;
use yii\helpers\Url;

class DirectoryTypes
{
    const UPLOADS = 1;

    public static $folderName = array(
        self::UPLOADS => 'uploads',

    );

    public static function getUploadsDirectory($is_relative = true, $for_frontend = false)
    {
        if($for_frontend){
            return Yii::$app->params['uploadsDirectory'];
        }else{
            if (!$is_relative) {
                $dir_path = \Yii::getAlias('@backend') . DIRECTORY_SEPARATOR . "web" . DIRECTORY_SEPARATOR . self::$folderName[self::UPLOADS] . DIRECTORY_SEPARATOR;
                if (!is_dir($dir_path)) {
                    mkdir($dir_path, 0755, false);
                }
                return Url::to($dir_path);
            } else {
                return Url::to(\Yii::getAlias('@web') . self::$folderName[self::UPLOADS] . DIRECTORY_SEPARATOR, true);
            }
        }
    }
}
?>