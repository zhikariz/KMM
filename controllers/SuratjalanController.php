<?php

namespace app\controllers;

use Yii;
use app\models\Suratjalan;
use app\models\SuratjalanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\Pengesah;
use app\models\Tahun;
use app\models\Satuankerja;
use yii\web\UploadedFile;
use app\models\TempSuratjalan;
/**
 * SuratjalanController implements the CRUD actions for Suratjalan model.
 */
class SuratjalanController extends Controller
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
     * Lists all Suratjalan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuratjalanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
        ]);
    }

    /**
     * Displays a single Suratjalan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($kode,$id)
    {
      $data = $this->getJenisDokumen();
      $data2 = $this->getSifatDokumen();
      $model = $this->findModel($id);
      $temp = json_decode($model->pengesah);
      for($i=0;$i<count($temp);$i++){
        $a[$i]='<button class="btn-xs btn btn-info" style="margin: 1px;">'.$temp[$i].'</button>';
      }
       $vl = implode('<br>',$a);
      $model->pengesah = $vl;
        return $this->render('view', [
            'model' => $model,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
        ]);
    }

    /**
     * Creates a new Suratjalan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($kode)
    {
        $model = new Suratjalan();
        $tahun = new Tahun();

        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();

        //tahun dari db
        $tahun_db = $tahun->find()->orderBy(['tahun'=>SORT_DESC])->one();
        //tahun sekarang
        $tahun_skr = date('Y');
        //ngambil data drop down
        $satker = ArrayHelper::map(Satuankerja::find()->all(), 'kode_satuan_kerja', 'ket_satuan_kerja');

        //ngambil data checkbox
        $pengesah = ArrayHelper::map(Pengesah::find()->all(), 'nama_pengesah', 'nama_pengesah');
        $no_dokumen_temp = $model->find()->orderBy(['no_dokumen'=>SORT_DESC])->one();

        if ($model->load(Yii::$app->request->post())) {
          $model->file_dokumen = UploadedFile::getInstance($model,'file_dokumen');
          if($tahun_skr != $tahun_db['tahun'] && $no_dokumen_temp['format_dokumen'] != $model->format_dokumen){
            $model->no_dokumen = 1;
            $model->kode_tahun = $tahun_db['kode_tahun'];
            $tahun->kode_tahun = $tahun_db['kode_tahun'] + 1;
            $tahun->tahun = date('Y');
            $tahun->save();
          }else{
            $model->kode_tahun = $tahun_db['kode_tahun'];
            $model->no_dokumen = $no_dokumen_temp['no_dokumen'] + 1;
          }
          $model->waktu_input = date("d-m-Y H:i:s");
          $model->id_user = Yii::$app->user->identity->id_user;
          $pengesah_temp = $model->pengesah;
          $model->pengesah = json_encode($pengesah_temp);
          $model->format_dokumen = $kode;
          $model->persetujuan = NULL;
          $model->ket_persetujuan = NULL;
          $model->save(false);
          if($model->file_dokumen != NULL)
          $model->file_dokumen->saveAs('uploads/' . $model->file_dokumen->baseName . '.' . $model->file_dokumen->extension);
          Yii::$app->getSession()->setFlash('success', [
         'text' => 'Dokumen Telah Disimpan',
         'title' => 'Tersimpan',
         'type' => 'success',
         'timer' => 3000,
         'showConfirmButton' => true
     ]);
            return $this->redirect(['view', 'kode'=>$kode,'id' => $model->id_surat_jalan]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2,
                'dataPengesah' => $pengesah,
                'dataSatker'=>$satker,
            ]);
        }
    }

    /**
     * Updates an existing Suratjalan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($kode,$id)
    {
        $model = $this->findModel($id);
        $temp_model = new TempSuratjalan();
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $dataSurat = $this->findModel($id);
        //ngambil data drop down
        $satker = ArrayHelper::map(Satuankerja::find()->all(), 'kode_satuan_kerja', 'ket_satuan_kerja');
        //ngambil data checkbox
        $pengesah = ArrayHelper::map(Pengesah::find()->all(), 'nama_pengesah', 'nama_pengesah');
        if ($model->load(Yii::$app->request->post()) ) {
          $temp_model->file_dokumen = UploadedFile::getInstance($model,'file_dokumen');
          if($temp_model->file_dokumen == NULL){
            $temp_model->file_dokumen = $dataSurat->file_dokumen;
          }
          if(Yii::$app->user->identity->role->ket_role == 'Administrator')
          {
              $temp_model->no_dokumen = $model->no_dokumen;
              $temp_model->kode_satuan_kerja = $model->kode_satuan_kerja;
          }else {
              $temp_model->no_dokumen = $dataSurat->no_dokumen;
              $temp_model->kode_satuan_kerja = $dataSurat->kode_satuan_kerja;
          }
          $temp_model->format_dokumen = $kode;
          $temp_model->id_user = $dataSurat->id_user;
          $temp_model->waktu_input = $dataSurat->waktu_input;
          $temp_model->editor = Yii::$app->user->identity->id_user;
          $temp_model->perihal = $model->perihal;
          $pengesah_temp = $model->pengesah;
          $temp_model->pengesah = json_encode($pengesah_temp);
          $temp_model->id_surat_jalan = $dataSurat->id_surat_jalan;
          $temp_model->kode_tahun = $dataSurat->kode_tahun;

          $this->actionBelum($kode,$id);
          $temp_model->save(false);

          if($temp_model->file_dokumen != $dataSurat->file_dokumen){
          $temp_model->file_dokumen->saveAs('uploads/' . $temp_model->file_dokumen->baseName . '.' . $temp_model->file_dokumen->extension);}
          Yii::$app->getSession()->setFlash('success', [
         'text' => 'Dokumen Selesai Terupdate Silahkan Tunggu Approval Untuk Menyetujui',
         'title' => 'Proses Update',
         'type' => 'success',
         'timer' => 3000,
         'showConfirmButton' => true
     ]);
            return $this->redirect(['view', 'kode'=>$kode,'id' => $model->id_surat_jalan]);
        } else {
          $temp_model_pengesah = json_decode($model->pengesah,true);
          $model->pengesah = $temp_model_pengesah;
            return $this->render('update', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2,
                'dataPengesah' => $pengesah,
                'dataSatker'=>$satker,
            ]);
        }
    }

    /**
     * Deletes an existing Suratjalan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($kode,$id)
    {
        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('success', [
       'text' => 'Dokumen Telah Terhapus',
       'title' => 'Terhapus',
       'type' => 'success',
       'timer' => 3000,
       'showConfirmButton' => true
   ]);

        return $this->redirect(['index','kode'=>$kode]);
    }



    public function actionBelum($kode,$id)
    {
        $model = $this->findModel($id);
        $model->persetujuan = 'Belum Disetujui';
        $model->ket_persetujuan=NULL;
          $model->save();
          return null;
    }

    /**
     * Finds the Suratjalan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Suratjalan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Suratjalan::findOne($id)) !== null) {
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
