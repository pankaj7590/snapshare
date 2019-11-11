<?php

namespace backend\controllers;

use Yii;
use common\models\Album;
use common\models\Media;
use common\models\User;
use common\models\Shared;
use common\models\AlbumSearch;
use common\models\MediaSearch;
use common\models\UserContactSearch;
use common\models\SharedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlbumController implements the CRUD actions for Album model.
 */
class AlbumController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Album models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlbumSearch();
		$searchModel->created_by = Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Album model.
     * @param varchar $slug
     * @return mixed
     */
    public function actionView($slug)
    {
		$model = $this->findModel($slug);
		
        $searchModel = new MediaSearch();
		$searchModel->album_id = $model->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Album model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Album();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'slug' => $model->slug]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Uploads a new Media models.
     * If upload is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionMedia($slug)
    {
		$model = $this->findModel($slug);
		
        $searchModel = new MediaSearch();
		$searchModel->album_id = $model->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('media', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model' => $model,
        ]);
    }

    /**
     * Uploads a new Media models.
     * If upload is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionUploadFiles($slug)
    {
		$model = $this->findModel($slug);

        if ($model->load(Yii::$app->request->post()) && $model->upload()) {
            return $this->redirect(['view', 'slug' => $model->slug]);
        } else {
            return $this->render('upload', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Album model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param varchar $slug
     * @return mixed
     */
    public function actionUpdate($slug)
    {
        $model = $this->findModel($slug);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'slug' => $model->slug]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Album model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param varchar $slug
     * @return mixed
     */
    public function actionDelete($slug)
    {
        $this->findModel($slug)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionSetCover($album,$image){
		$model = $this->findModel($album);
		$modelImage = $this->findModelMedia($image);
		
		if($model->id == $modelImage->album_id){
			$model->cover_image_id = $modelImage->id;
			if($model->save()){
				
			}
		}
		return $this->redirect(['view', 'slug' => $album]);
	}
	
	public function actionShare($slug){
		$model = $this->findModel($slug);
		
		$searchModel = new UserContactSearch();
		$searchModel->user_id = Yii::$app->user->id;
		$dataProvider = $searchModel->search([]);
		
		$searchModelShared = new SharedSearch();
		$searchModelShared->album_id = $model->id;
		$dataProviderShared = $searchModelShared->search([]);
		
		if($model->load(Yii::$app->request->post()) && $model->share()){
			Yii::$app->session->setFlash('success', 'Please ask the invited user to check email and accept the invitation.');
			return $this->redirect(['view', 'slug' => $model->slug]);
		}
		
		return $this->render('share', [
			'model' => $model,
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
			'searchModelShared' => $searchModelShared,
			'dataProviderShared' => $dataProviderShared,
		]);
	}

    /**
     * Deletes an existing Shared model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRemoveShared($album, $with)
    {
        $model = $this->findModel($album);
		$userModel = User::findOne(['username' => $with]);
		if(!$userModel){
			throw new NotFoundHttpException('User album shared with is not found.');
		}
		$modelShared = Shared::findOne(['shared_with' => $userModel->id, 'album_id' => $model->id]);
		if(!$modelShared){
			throw new NotFoundHttpException('Album is not shared with the user.');
		}
		if($modelShared->delete()){
			Yii::$app->session->setFlash('success', 'User removed successfully.');
		}else{
			Yii::$app->session->setFlash('error', 'Something went wrong. Please try again.');
		}

        return $this->redirect(['share', 'slug' => $album]);
    }

    /**
     * Downloads a single Shared model.
     * @param string $slug
     * @return mixed
     */
    public function actionDownload($slug)
    {
		$model = $this->findModel($slug);
		
		$model->download();
		
		die();
    }

    /**
     * Finds the Album model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param varchar $slug
     * @return Album the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
        if (($model = Album::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested album does not exist.');
        }
    }

    /**
     * Finds the Media model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param varchar $slug
     * @return Media the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelMedia($slug)
    {
        if (($model = Media::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested file does not exist.');
        }
    }
}
