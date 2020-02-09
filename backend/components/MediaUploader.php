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
    public static function MediaUpload(UploadedFile $upFile, $album_id = null, $do_compress = true)
    {
        $mediaModel = new Media();
        $mediaModel->album_id = $album_id;
        $mediaModel->alt = $upFile->baseName;
        $itemName = md5(uniqid(time(), true)) . '.' . $upFile->extension; // unique_name+extension
        $mediaModel->file_name = $itemName;
        $mediaModel->file_size = $upFile->size;
        $mediaModel->file_type = $upFile->type;
        $mediaModel->is_compressed = $do_compress;
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
	
	
	public static function compressImage($source_url, $destination_url, $quality) {
		$info = getimagesize($source_url);
		try{
			$image = imagecreatefromjpeg($source_url);
			
			//https://medium.com/thetiltblog/fixing-rotated-mobile-image-uploads-in-php-803bb96a852c : fix rotating image issue when uploading
			if (function_exists('exif_read_data')) {
				$exif = @exif_read_data($source_url);
				if($exif && isset($exif['Orientation'])) {
					$orientation = $exif['Orientation'];
					if($orientation != 1){
						$deg = 0;
						switch ($orientation) {
							case 3:
								$deg = 180;
								break;
							case 6:
								$deg = 270;
								break;
							case 8:
								$deg = 90;
								break;
						}
						if ($deg) {
							$image = imagerotate($image, $deg, 0);        
						}
					}
				}
			}
			imagejpeg($image, $destination_url, $quality);
		}catch(Exception $e){
			//if compression fails then return source file url
			return $source_url;
		}
		return $destination_url;
	}
} 