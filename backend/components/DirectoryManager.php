<?php
namespace backend\components;

use yii\base\Component;
use common\models\enums\DirectoryTypes;

class DirectoryManager extends Component
{
    public static function deleteUploadsDirectory()
    {
        $dir_path = DirectoryTypes::getUploadsDirectory(false);
        if (!is_dir($dir_path)) {
            self::rrmdir($dir_path);
        }
    }

    private static function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir")
                        rrmdir($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}