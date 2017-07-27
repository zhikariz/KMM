<?php

namespace app\controllers;

use Yii;
use app\models\Jenisdokumen;
use app\models\JenisdokumenSearch;
use app\models\Sifatdokumen;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JenisdokumenController implements the CRUD actions for Jenisdokumen model.
 */
class JenisdokumenController extends Controller
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
     * Lists all Jenisdokumen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JenisdokumenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $data_jenis_dokumen = Jenisdokumen::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
            'data_jenis_dokumen' => $data_jenis_dokumen,
        ]);
    }

    /**
     * Displays a single Jenisdokumen model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
      $data = $this->getJenisDokumen();
      $data2 = $this->getSifatDokumen();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
        ]);
    }

    /**
     * Creates a new Jenisdokumen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Jenisdokumen();
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        if ($model->load(Yii::$app->request->post())) {
            $temp = json_encode($model->format_jenis_dokumen);
            $model->format_jenis_dokumen = $temp;
            $model->save();
            return $this->redirect(['view', 'id' => $model->kode_jenis_dokumen]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2
            ]);
        }
    }

    /**
     * Updates an existing Jenisdokumen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        if ($model->load(Yii::$app->request->post())) {
          $temp = json_encode($model->format_jenis_dokumen);
          $model->format_jenis_dokumen = $temp;
          $model->save();
            return $this->redirect(['view', 'id' => $model->kode_jenis_dokumen,'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2]);
        } else {
          $temp = json_decode($model->format_jenis_dokumen);
          $model->format_jenis_dokumen = $temp;
            return $this->render('update', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2
            ]);
        }
    }

    /**
     * Deletes an existing Jenisdokumen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        return $this->redirect(['index','dataJenisDokumen' => $data,
        'dataSifatDokumen' => $data2]);
    }

    /**
     * Finds the Jenisdokumen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Jenisdokumen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jenisdokumen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function getJenisDokumen()
    {
      return Jenisdokumen::find()->orderBy(['kode_jenis_dokumen'=>SORT_DESC])->all();
    }
    public function getSifatDokumen()
    {
      return Sifatdokumen::find()->orderBy(['kode_sifat_dokumen'=>SORT_DESC])->all();
    }

}
