<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;
use yii\web\UploadedFile;
use common\models\enums\MediaTypes;
use backend\components\MediaUploader;

/**
 * Profile pic change form
 */
class ChangeProfilePicForm extends Model
{
    public $temp_pic;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['temp_pic'], 'required'],
            [['temp_pic'], 'file', 'extensions' => 'png, jpg, jpeg, gif', 'mimeTypes' => 'image/jpeg, image/png, image/gif'],
        ];
    }
	
	public function attributeLabels(){
		return [
			'temp_pic' => 'Profile Pic',
		];
	}
	
	public function change(){
		$temp_pic = UploadedFile::getInstance($this, 'temp_pic');
		if($temp_pic){
			if ($temp_pic != null && !$temp_pic->getHasError()) {
				//compress file if requested by user and it is an image
				if ($temp_pic->type == "image/jpeg"){
					// echo "<pre>";print_r($this);exit;
					$url = $temp_pic->tempName;
					$quality = Yii::$app->params['default_compress_quality'];
					//keeping both urls same so that, temporary file will be compressed and later moved to uploads folder
					MediaUploader::compressImage($url, $url , $quality);
					$temp_pic->size = filesize($url);
				}
				$media_id = MediaUploader::MediaUpload($temp_pic, null, 1);
				if ($media_id) {
					$user = Yii::$app->user->identity;
					$user->updateAttributes(['profile_pic_id' => $media_id, 'updated_at' => time(), 'updated_by' => Yii::$app->user->id]);
				}else{
					Yii::$app->session->setFlash('error', 'Profile picture not saved. Please try again later.');
					return false;
				}
			}else{
				// echo "<pre>";print_r($temp_pic->error);exit;
			}
		}
		return true;
    }
}
