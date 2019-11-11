<?php

namespace backend\controllers;

use Yii;
use common\models\Album;
use common\models\Shared;
use common\models\SharedSearch;
use common\models\MediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SharedController implements the CRUD actions for Shared model.
 */
class SharedController extends Controller
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
     * Lists all Shared models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SharedSearch();
		$searchModel->shared_with = Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Shared model.
     * @param string $slug
     * @return mixed
     */
    public function actionView($slug)
    {
		$model = $this->findModel($slug);
		
        $searchModel = new MediaSearch();
		$searchModel->album_id = $model->album_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('view_shared', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Shared model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Shared();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Shared model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Shared model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Downloads a single Shared model.
     * @param string $slug
     * @return mixed
     */
    public function actionDownload($slug)
    {
		$model = $this->findModel($slug);
		
		$model->album->download();		
    }

    /**
     * Finds the Shared model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $slug
     * @return Shared the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($slug)
    {
		$albumModel = Album::findOne(['slug' => $slug]);
        if ($albumModel && ($model = Shared::findOne(['shared_with' => Yii::$app->user->id, 'album_id' => $albumModel->id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested album does not exist or is not shared with you.');
        }
    }
}
