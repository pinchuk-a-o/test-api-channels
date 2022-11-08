<?php

namespace backend\controllers;

use backend\models\ars\Channel;
use backend\models\forms\ChannelImgForm;
use backend\models\searches\ChannelSearch;
use common\cacheKeys\ChannelsAll;
use common\services\storage\IStorageService;
use common\services\storage\StorageService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ChannelController implements the CRUD actions for Channel model.
 */
class ChannelController extends Controller
{
    private StorageService $storageService;

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

    public function __construct($id, $module, StorageService $storageService, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->storageService = $storageService;
    }

    public function actionIndex(): string
    {
        $searchModel = new ChannelSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate(): Response|string
    {
        $model = new Channel();
        $logoFileForm = new ChannelImgForm();

        if ($this->request->isPost) {
            $logoFileForm->logo = UploadedFile::getInstance($logoFileForm, 'logo');

            if ($logoFileForm->validate() && $logoFileForm->logo) {
                $model->logo = $this->storageService->saveAs($logoFileForm->logo, StorageService::LOGO_CATALOG);
            }

            if ($model->load($this->request->post()) && $model->save()) {
                $cache = \Yii::$app->cache;
                $cache->delete(ChannelsAll::KEY);

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'logoFileForm' => $logoFileForm,
        ]);
    }

    public function actionUpdate($id): Response|string
    {
        $model = $this->findModel($id);
        $logoFileForm = new ChannelImgForm();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($logoFileForm->load($this->request->post()) && $logoFileForm->delete_img) {
                    $this->storageService->dropFile($model->logo);
                    $model->logo = null;
                }

                $logoFileForm->logo = UploadedFile::getInstance($logoFileForm, 'logo');

                if ($logoFileForm->validate() && $logoFileForm->logo) {
                    $model->logo = $this->storageService->saveAs($logoFileForm->logo, StorageService::LOGO_CATALOG);
                }

                if ($model->save()) {
                    $cache = \Yii::$app->cache;
                    $cache->delete(ChannelsAll::KEY);

                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    if ($model->logo) {
                        $this->storageService->dropFile($model->logo);
                    }
                }
            }
        }

        return $this->render('update', [
            'model' => $model, 'logoFileForm' => $logoFileForm
        ]);
    }

    public function actionDelete($id): Response
    {
        $this->findModel($id)->delete();

        $cache = \Yii::$app->cache;

        $cache->delete(ChannelsAll::KEY);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Channel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Channel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Channel
    {
        if (($model = Channel::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
