<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password change form
 */
class ChangePasswordForm extends Model
{
    public $old_password;
    public $password;
    public $re_password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'old_password', 're_password'], 'required'],
            [['password', 'old_password', 're_password'], 'string', 'min' => 6],
			['password', 'compare', 'compareAttribute'=>'re_password', 'on'=>'changePwd'],
            ['re_password', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"],
            ['old_password', 'validatePassword'],
        ];
    }

    public function validatePass($password)
    {
        return Yii::$app->security->validatePassword($password, Yii::$app->user->identity->password_hash);
    }
	
	public function attributeLabels(){
		return [
			'password' => 'Password',
			'old_password' => 'Old Password',
			're_password' => 'Re-enter Password',
		];
	}

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user->validatePassword($this->password)) {
                $this->addError($attribute,'Old password is incorrect');
            }
        }
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $user = User::findOne(Yii::$app->user->identity->id);
        }

        return $this->_user;
    }
}
