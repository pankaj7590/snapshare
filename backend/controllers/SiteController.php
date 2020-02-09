<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\ChangePasswordForm;
use backend\models\ChangeProfilePicForm;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'backup', 'delete-backup', 'change-password', 'change-profile-pic', 'remove-profile-pic'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete-backup' => ['post'],
                    'remove-profile-pic' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$users = User::find()->limit(30)->all();
        return $this->render('index', [
			'users' => $users,
		]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	
	public function actionBackup()
    {
		if(Yii::$app->request->post()){
			$backup = \Yii::$app->backup;
			if($file = $backup->create()){
				return $this->redirect(['backup']);
			}else{
				exit;
			}
		}
		return $this->render('backup');
    }
	
	public function actionDeleteBackup($name){
		\yii\helpers\FileHelper::unlink(\Yii::getAlias('@backups').'/'.$name);
		
		return $this->redirect(['backup']);
	}

    public function actionChangePassword()
    {
        $user = Yii::$app->user->identity;
        $model = new ChangePasswordForm();
        
        if ($model->load(Yii::$app->request->post())) {
            $user->scenario = "change-password";
            if($model->validatePass($model->old_password)){
                $user->setPassword($model->password);
                if($user->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Password updated successfully.');
                    return $this->redirect(['site/change-password']);
                }else{
                    Yii::$app->getSession()->setFlash('danger', 'Password not updated.');
                }
            }else{
                Yii::$app->getSession()->setFlash('danger', 'Incorrect Password.');
            }
        }
		return $this->render('change-password',[
			'model'=>$model,
		]);
    }
	
	public function actionChangeProfilePic(){
		$model = new ChangeProfilePicForm();
		if($model->load(Yii::$app->request->post()) && $model->change()){
			return $this->redirect(['change-profile-pic']);
		}
		return $this->render('change-profile-pic', [
			'model' => $model,
		]);
	}
	
	public function actionRemoveProfilePic(){
		$model = Yii::$app->user->identity;
		if($model->removeProfilePic()){
			Yii::$app->session->setFlash('success', 'Profile pic removed.');
		}
		return $this->redirect(['change-profile-pic']);
	}
}
