<?php

namespace app\controllers;

use Yii;
use app\models\Dokumenmasuk;
use app\models\DokumenmasukSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Tahun;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\Tim;
use app\models\Unitkerja;
use app\models\Petunjuk;
use yii\web\UploadedFile;

/**
 * DokumenmasukController implements the CRUD actions for Dokumenmasuk model.
 */
class DokumenmasukController extends Controller
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
     * Lists all Dokumenmasuk models.
     * @return mixed
     */
    public function actionIndex($sifat)
    {
        $searchModel = new DokumenmasukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $data_dokumen_masuk = Dokumenmasuk::find()->where(['kode_sifat_dokumen'=>$sifat])->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
            'dataDokumenMasuk' => $data_dokumen_masuk,
        ]);
    }

    /**
     * Displays a single Dokumenmasuk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($sifat,$id)
    {
      $data = $this->getJenisDokumen();
      $data2 = $this->getSifatDokumen();
      $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
        ]);
    }

    /**
     * Creates a new Dokumenmasuk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($sifat)
    {
        $model = new Dokumenmasuk();
        $tahun = new Tahun();
        //tahun dari db
        $tahun_db = $tahun->find()->orderBy(['tahun'=>SORT_DESC])->one();
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();

        $tahun_skr = date('Y');
        //ngambil data checkbox
        $dataUnit = ArrayHelper::map(Unitkerja::find()->all(), 'ket_unit_kerja', 'ket_unit_kerja');
        $dataTim = ArrayHelper::map(Tim::find()->all(), 'nama_tim', 'nama_tim');
        $dataPetunjuk= ArrayHelper::map(Petunjuk::find()->all(), 'keterangan_petunjuk', 'keterangan_petunjuk');

        if ($model->load(Yii::$app->request->post())) {
          $temp = json_encode($model->tujuan_disposisi);
          $model->tujuan_disposisi = $temp;

          $temp2 = json_encode($model->petunjuk_disposisi);
          $model->petunjuk_disposisi = $temp2;

          $model->file_dokumen = UploadedFile::getInstance($model,'file_dokumen');


          $model->kode_sifat_dokumen = $sifat;
          $model->waktu_input = date("d-m-Y H:i:s");
          $model->id_user = Yii::$app->user->identity->id_user;
          $model->save();
          if($model->file_dokumen != NULL)
          $model->file_dokumen->saveAs('uploads/' . $model->file_dokumen->baseName . '.' . $model->file_dokumen->extension);
            return $this->redirect(['view','sifat'=>$sifat,'id' => $model->id_dokumen_masuk,'model' => $model,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2,
                'dataUnit'=>$dataUnit,
                'dataTim'=>$dataTim,
                'dataPetunjuk'=>$dataPetunjuk
            ]);
        }
    }

    /**
     * Updates an existing Dokumenmasuk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_dokumen_masuk]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2,
            ]);
        }
    }

    /**
     * Deletes an existing Dokumenmasuk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($sifat,$id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index','sifat'=>$sifat]);
    }

    /**
     * Finds the Dokumenmasuk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dokumenmasuk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dokumenmasuk::findOne($id)) !== null) {
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
