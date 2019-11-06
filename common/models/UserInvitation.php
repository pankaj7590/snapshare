<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user_invitation".
 *
 * @property int $id
 * @property int $user_id
 * @property string $email
 * @property string $invitation_token
 * @property int $is_accepted
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Invitation[] $invitations
 * @property User $user
 */
class UserInvitation extends \yii\db\ActiveRecord
{
	public $temp_album_id;
	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_invitation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'email'], 'required'],
            [['user_id', 'is_accepted', 'status', 'created_at', 'updated_at'], 'integer'],
            [['email', 'invitation_token'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['invitation_token'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'email' => 'Email',
            'invitation_token' => 'Invitation Token',
            'is_accepted' => 'Is Accepted',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitations()
    {
        return $this->hasMany(Invitation::className(), ['user_invitation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
		
		//save invitation every time as duplication is not possible because of the unique constraint present for user_invitation_id and album_id combination.
		$invitation = new Invitation();
		$invitation->user_invitation_id = $this->id;
		$invitation->album_id = $this->temp_album_id;
		$invitation->save();
		
		return;
	}
	
    /**
     * Finds user by invitation token
     *
     * @param string $token invitation token
     * @return static|null
     */
    public static function findByToken($token) {
        return static::findOne([
            'invitation_token' => $token,
        ]);
    }
}
