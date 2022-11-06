<?php

namespace app\controllers;

use app\helpers\Helper;
use app\models\Files;
use app\models\FilesSearch;
use app\models\Queue;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FilesController implements the CRUD actions for Files model.
 */
class FilesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Files models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FilesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Files model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Files model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Files();

        if ($model->load(Yii::$app->request->post())) {
            $this->uploadFile($model);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Files model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->file) {
                $this->uploadFile($model);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Files model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Files model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Files the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Files::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function uploadFile($model)
    {
        $old_file = $model->url;

        $model->file = UploadedFile::getInstance($model, 'file');
        if (isset($model->file)) {
            $model->url = md5(uniqid(true) . rand(0, 999999)) . '.' . $model->file->extension;
            $model->extension = $model->file->extension;

            $model->user_id = Yii::$app->getUser()->id;

            if ($model->upload()) {
                if ($model->save()) {
                    if (file_exists(\Yii::getAlias('@webroot') . $old_file)) {
                        @unlink(\Yii::getAlias('@webroot') . $old_file);
                    }

                    $queue = new Queue();
                    $queue->load([
                        'file_id' => $model->id,
                        'status' => 'new'
                    ], '');
                    $queue->save();

                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $model->getErrors();
                }
            }
        }

        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }
}
