<?php
namespace common\models\enums;

class MediaTypes{
	const IMAGE = 1;
	const VIDEO = 2;
	const DOCUMENT = 3;
	const AUDIO = 4;
	const APPLICATION = 5;
	
	const IMAGE_JPG = 1.1;
	const IMAGE_JPEG = 1.2;
	const IMAGE_PNG = 1.3;
	const IMAGE_GIF = 1.4;
	
	const VIDEO_MP4 = 2.1;
	const VIDEO_AVI = 2.2;
	
	const DOCUMENT_DOC = 3.1;
	const DOCUMENT_EXCEL = 3.2;
	const DOCUMENT_PDF = 3.3;
	const DOCUMENT_WORD = 3.4;
	const DOCUMENT_TXT = 3.5;
	
	public static $types = [
		self::IMAGE => 'Image',
		self::VIDEO => 'Video',
		self::DOCUMENT => 'Document',
		self::APPLICATION => 'Application',
	];
	
	public static $subTypes = [
		self::IMAGE => [
			self::IMAGE_JPG => 'JPG',
			self::IMAGE_JPEG => 'JPEG',
			self::IMAGE_PNG => 'PNG',
			self::IMAGE_GIF => 'GIF',
		],
		self::VIDEO => [
			self::VIDEO_MP4 => 'MP4',
			self::VIDEO_AVI => 'AVI',
		],
		self::DOCUMENT => [
			self::DOCUMENT_DOC => 'Doc',
			self::DOCUMENT_EXCEL => 'Excel',
			self::DOCUMENT_PDF => 'PDF',
			self::DOCUMENT_WORD => 'Word',
			self::DOCUMENT_TXT => 'Text',
		],
		self::AUDIO => [],
		self::APPLICATION => [],
	];
	
	public static $extensions = [
		self::IMAGE => ['.jpg', '.jpeg', '.png', '.gif'],
		self::VIDEO => ['.mp4', '.avi'],
		self::DOCUMENT => ['.doc', '.docx', '.xls', '.xlsx', '.pdf', '.word', '.txt'],
		self::AUDIO => ['.mp3'],
		self::APPLICATION => [],
	];
	
	public static $fileTypes = [
		self::IMAGE => ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'],
		self::VIDEO => ['.mp4', '.avi'],
		self::DOCUMENT => ['.doc', '.docx', '.xls', '.xlsx', '.pdf', '.word', '.txt'],
		self::AUDIO => ['.mp3'],
		self::APPLICATION => [],
	];
}
?>