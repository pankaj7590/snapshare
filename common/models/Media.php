<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;
use common\models\enums\MediaTypes;
use common\components\GeneralHelper;

/**
 * This is the model class for table "media".
 *
 * @property int $id
 * @property int $album_id
 * @property string $file_name
 * @property string $file_type
 * @property int $file_size
 * @property string $alt
 * @property string $slug
 * @property int $link_shared
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
class Media extends \yii\db\ActiveRecord
{	
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
        return 'media';
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
                'attribute' => 'alt',
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
            [['file_name', 'file_type', 'file_size', 'alt', 'slug'], 'required'],
            [['file_size', 'link_shared', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['file_name', 'file_type', 'alt', 'slug'], 'string', 'max' => 255],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'album_id' => 'Album',
            'file_name' => 'File Name',
            'file_type' => 'File Type',
            'file_size' => 'File Size',
            'alt' => 'Alt',
            'slug' => 'Slug',
            'link_shared' => 'Link Shared',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum()
    {
        return $this->hasOne(Album::className(), ['id' => 'album_id']);
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
        return $this->hasMany(Shared::className(), ['media_id' => 'id']);
    }
	
	public function getDummyImage(){
		return Yii::$app->urlManager->baseUrl.'/images/'.Yii::$app->params['dummyImage'];
	}
	
	public function isImage(){
		return (in_array($this->file_type, MediaTypes::$fileTypes[MediaTypes::IMAGE]));
	}
	
	public function getAlbumCover(){
		return $this->hasOne(Album::className(), ['cover_image_id' => 'id']);
	}
	
	public function getFileSize(){
		return GeneralHelper::formatSize($this->file_size);
	}
}
