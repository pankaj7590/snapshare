<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\UserInvitation;
use common\models\Shared;
use yii\base\InvalidArgumentException;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $invitation_token;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['invitation_token', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
		
		if($this->invitation_token){
			$userInvitation = UserInvitation::findByToken($this->invitation_token);
			if (!$userInvitation) {
				throw new InvalidArgumentException('Wrong invitation token.');
			}
		}
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
		//if user is invited then created by and updated by fields will have user id of inviting user else detach blameable behavior to avoid validation failure
		if(isset($userInvitation)){
			$user->detachBehavior('blameable');
			$user->created_by = $userInvitation->user_id;
			$user->updated_by = $userInvitation->user_id;
		}else{
			$user->detachBehavior('blameable');
		}
        if($user->save() && $this->sendEmail($user)){
			// the following three lines were added:
			$auth = \Yii::$app->authManager;
			$subscriberRole = $auth->getRole('Subscriber');//create Subscriber role in Yii2 Admin if not already present
			$auth->assign($subscriberRole, $user->getId());
			
			if(isset($userInvitation)){
				$invitations = $userInvitation->invitations;
				foreach($invitations as $invitation){
					$shared = new Shared();
					$shared->detachBehavior('blameable');
					$shared->shared_with = $user->id;
					$shared->album_id = $invitation->album_id;
					$shared->created_by = $userInvitation->user_id;
					$shared->updated_by = $userInvitation->user_id;
					$shared->save();
				}
			}
			return true;
		}
		return false;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
