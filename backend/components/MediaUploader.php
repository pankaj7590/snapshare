<?php

namespace backend\components;

use common\models\enums\MediaTypes;
use common\models\enums\DirectoryTypes;
use Yii;
use yii\base\Component;
use common\models\Media;
use yii\web\UploadedFile;

class MediaUploader extends Component
{
	/*
	*	$upFile object of file to be uploaded
	*	$image_type type either from MediaTypes
	*/
    public static function MediaUpload(UploadedFile $upFile, $album_id = null)
    {
        $mediaModel = new Media();
        $mediaModel->album_id = $album_id;
        $mediaModel->alt = $upFile->name;
        $itemName = md5(uniqid(time(), true)) . '.' . $upFile->extension; // unique_name+extension
        $mediaModel->file_name = $itemName;
        $mediaModel->file_size = $upFile->size;
        $mediaModel->file_type = $upFile->type;
        if($mediaModel->save()){
            $upFile->saveAs(DirectoryTypes::getUploadsDirectory(false) . $itemName);
			return $mediaModel->id;
        }
        return false;
    }

    public static function deleteFile($itemName){
		if(file_exists(DirectoryTypes::getUploadsDirectory(false) . $itemName)){
			unlink(DirectoryTypes::getUploadsDirectory(false) . $itemName);
		}
		return true;
    }
} 