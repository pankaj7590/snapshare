<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\imagine\Image;
use common\models\enums\DirectoryTypes;

class ImageHelper extends Component{
	const TYPE_THUMBNAIL = 1;
	const TYPE_CROPPED = 2;
	const TYPE_CROPPED_THUMBNAIL = 3;
	
	public static $types = [
		self::TYPE_THUMBNAIL => 'Thumbnail',
		self::TYPE_CROPPED => 'Cropped',
		self::TYPE_CROPPED_THUMBNAIL => 'Cropped Thumbnail',
	];
	
	const FOR_BACKEND = 0;	//indicates false for DirectoryTypes getUploadsDirectory function
	const FOR_FRONTEND = 1;	//indicates true for DirectoryTypes getUploadsDirectory function
	
	public static $for = [
		self::FOR_BACKEND => 'For Backend',
		self::FOR_FRONTEND => 'For Frontend',
	];
	
	public function getImage($file_name, $options = []){//$width = 50, $height = null, $cropped = []){
		//default
		$width = 50;
		$height = null;
		$quality = 50;
		$cropped = [];
		$type = self::TYPE_THUMBNAIL;
		$for = self::FOR_BACKEND;
		$override = false;
		
		//override default if present in options array
		if(isset($options['width'])){
			$width = $options['width'];
		}
		if(isset($options['height'])){
			$height = $options['height'];
		}
		if(isset($options['quality'])){
			$quality = $options['quality'];
		}
		if(isset($options['cropped'])){
			$cropped = $options['cropped'];
		}
		if(isset($options['type'])){
			$type = $options['type'];
		}
		if(isset($options['for'])){
			$for = $options['for'];
		}
		if(isset($options['override'])){
			$override = $options['override'];
		}
		
		//local path eg: C:\xampp\htdocs\snapshare\backend.....
		$path = DirectoryTypes::getUploadsDirectory(false);
		
		//http://snapshare.local/uploads
		$url = DirectoryTypes::getUploadsDirectory(true, $for);
		
		//generate thumbnail file name
		$imagename = $width.'x'.$height.'_'.$file_name;

		//check if the image with above name already exists with specified dimensions and generate that only if not present
		if(file_exists(Yii::getAlias($path.$imagename)) && !$override){
			return $url.$imagename;
		}else{
			$cropped_width = $width;
			$cropped_height = $height;
			$cropped_start = [0,0];
			if(isset($cropped['width'])){
				$cropped_width = $cropped['width'];
			}
			if(isset($cropped['height'])){
				$cropped_height = $cropped['height'];
			}
			if(isset($cropped['start'])){
				$cropped_start = $cropped['start'];
			}
			switch($type){
				case self::TYPE_CROPPED:
					Image::crop($path.$file_name, $cropped_width, $cropped_height, $cropped_start)->save($path.$imagename, ['quality' => $quality]);
					break;
				case self::TYPE_CROPPED_THUMBNAIL:
					Image::crop($path.$file_name, $cropped_width, $cropped_height, $cropped_start)->thumbnail($path.$file_name, $width, $height)->save(Yii::getAlias($path.$imagename), ['quality' => $quality]);
					break;
				default:
					Image::thumbnail($path.$file_name, $width, $height)->save(Yii::getAlias($path.$imagename), ['quality' => $quality]);
			}
		}
		return Yii::getAlias($url.$imagename);
	}
}
?>