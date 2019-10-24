<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invitation".
 *
 * @property int $id
 * @property int $user_invitation_id
 * @property int $album_id
 * @property int $media_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Album $album
 * @property Media $media
 * @property UserInvitation $userInvitation
 */
class Invitation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invitation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_invitation_id', 'created_at', 'updated_at'], 'required'],
            [['user_invitation_id', 'album_id', 'media_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['album_id'], 'exist', 'skipOnError' => true, 'targetClass' => Album::className(), 'targetAttribute' => ['album_id' => 'id']],
            [['media_id'], 'exist', 'skipOnError' => true, 'targetClass' => Media::className(), 'targetAttribute' => ['media_id' => 'id']],
            [['user_invitation_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserInvitation::className(), 'targetAttribute' => ['user_invitation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_invitation_id' => 'User Invitation ID',
            'album_id' => 'Album ID',
            'media_id' => 'Media ID',
            'status' => 'Status',
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
    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id' => 'media_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInvitation()
    {
        return $this->hasOne(UserInvitation::className(), ['id' => 'user_invitation_id']);
    }
}
