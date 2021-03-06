<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;
use common\models\enums\MediaTypes;
use backend\components\MediaUploader;
use common\components\GeneralHelper;

/**
 * This is the model class for table "album".
 *
 * @property int $id
 * @property int $cover_image_id
 * @property string $name
 * @property string $slug
 * @property int $is_link_shared
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Shared[] $shareds
 */
class Album extends \yii\db\ActiveRecord
{
	public $temp_files, $temp_emails, $do_compress, $compress_quality;
	
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
	
	public static $statuses = [
		self::STATUS_ACTIVE => 'Active',
		self::STATUS_INACTIVE => 'Inactive',
		self::STATUS_DELETED => 'Deleted',
	];
	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'album';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
			[
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['is_link_shared', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['cover_image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Media::className(), 'targetAttribute' => ['cover_image_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
			[['temp_files', 'temp_emails', 'do_compress', 'compress_quality'], 'safe'],
			[['compress_quality'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cover_image_id' => 'Cover Image',
            'name' => 'Name',
            'slug' => 'Slug',
            'is_link_shared' => 'Is Link Shared?',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'temp_files' => 'Files',
			'do_compress' => 'Compress files before uploading?',
			'compress_quality' => 'Compress quality(in %)'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShareds()
    {
        return $this->hasMany(Shared::className(), ['album_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoverImage()
    {
        return $this->hasOne(Media::className(), ['id' => 'cover_image_id']);
    }
	
	public function upload(){
		$temp_files = UploadedFile::getInstances($this, 'temp_files');
		if($temp_files){
			foreach($temp_files as $temp_file){
				if ($temp_file != null && !$temp_file->getHasError()) {
					//compress file if requested by user and it is an image
					if ($this->do_compress && (($temp_file->type == "image/jpeg"))) {
						// echo "<pre>";print_r($this);exit;
						$url = $temp_file->tempName;
						$quality = (isset($this->compress_quality)?$this->compress_quality:Yii::$app->params['default_compress_quality']);
						//keeping both urls same so that, temporary file will be compressed and later moved to uploads folder
						MediaUploader::compressImage($url, $url , $quality);
						$temp_file->size = filesize($url);
					}
					$media_id = MediaUploader::MediaUpload($temp_file, $this->id, $this->do_compress);
					if ($media_id === false) {
						return false;
					}
				}
			}
		}
		return true;
    }
	
	public function getMedia(){
		return $this->hasMany(Media::className(), ['album_id' => 'id']);
	}
	
	public function getAlbumSize($raw=false){
		$size = 0;
		foreach($this->media as $file){
			$size += $file->file_size;
		}
		if($raw){
			return $size;
		}else{
			return GeneralHelper::formatSize($size);
		}
	}
	
	public function share(){
		if($this->temp_emails){
			// echo "<pre>";print_r($this->temp_emails);exit;
			foreach($this->temp_emails as $temp_email){
				//$temp_email may contain id of existing user contact or an email id of new user being invited on the platform
				$userContact = UserContact::findOne($temp_email);
				if($userContact !== null){
					//if user already exists, share the album with the user
					$shared = new Shared();
					$shared->shared_with = $userContact->user_id;
					$shared->album_id = $this->id;
					$shared->save();
				}else{
					$userInvitation = UserInvitation::findOne(['email' => $temp_email]);
					if(!$userInvitation){
						//if user invitation does not exists then send an invitation to the user
						$userInvitation = new UserInvitation();
						$userInvitation->user_id = Yii::$app->user->id;
						$userInvitation->email = $temp_email;
						$userInvitation->invitation_token = Yii::$app->security->generateRandomString();
					}
					$userInvitation->temp_album_id = $this->id;
					$userInvitation->save();
				}
			}
		}
		return true;
	}
	
	public function download(){
		$mediaModels = $this->media;
		
		//http://www.bsourcecode.com/2013/04/yii-zip-format/
		//built in php class ZipArchive;
		$zip=new \ZipArchive();
		$archieveName = ($this->slug)."_".time();
		$destination = \yii\helpers\Url::to("@backend/web/archieves/".$archieveName.".zip");//Eg:lorem-sit_1573394349.zip
		if($zip->open($destination,\ZIPARCHIVE::CREATE) !== true) {
			// echo $destination;exit;
			return false;
		}
		foreach($mediaModels as $mediaModel){
			$filePath = \yii\helpers\Url::to("@backend/web/uploads/".$mediaModel->file_name);
			// echo $filePath;exit;
			$fileName = $mediaModel->file_name;
			$zip->addFile($filePath, $fileName);
		}
		$zip->close();

		if(file_exists($destination)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($destination).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($destination));
			flush(); // Flush system output buffer
			readfile($destination);
			exit;
		}
	}
}