<?php
namespace common\components;

class GeneralHelper{

	//$size in bytes
	public static function formatSize($size){
		//from https://subinsb.com/convert-bytes-kb-mb-gb-php/
		$base = log($size) / log(1024);
		$suffix = array("bytes", "KB", "MB", "GB", "TB");
		$f_base = floor($base);
		return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
	}
}
?>