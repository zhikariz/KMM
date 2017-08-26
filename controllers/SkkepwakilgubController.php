<?php

namespace app\controllers;

use Yii;
use app\models\SkKepwakilGub;
use app\models\SkKepwakilGubSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\Pengesah;
use app\models\Tahun;
use yii\web\UploadedFile;
use app\models\TempSkKepwakilGub;

/**
 * SkKepwakilGubSjalanController implements the CRUD actions for SkKepwakilGubSjalan model.
 */
class SkkepwakilgubController extends Controller
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
     * Lists all SkKepwakilGubSjalan models.
     * @return mixed
     */
    public function actionIndex($kode)
    {
        $searchModel = new SkKepwakilGubSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$kode);
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
     * Displays a single SkKepwakilGubSjalan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($kode,$id)
    {
      $data = $this->getJenisDokumen();
      $data2 = $this->getSifatDokumen();
      $model=$this->findModel($id);
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
     * Creates a new SkKepwakilGubSjalan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($kode)
    {
        $model = new SkKepwakilGub();
        $tahun = new Tahun();

        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        //tahun sekarang
        $tahun_skr = date('Y');
        //tahun dari db
        $tahun_db = $tahun->find()->orderBy(['tahun'=>SORT_DESC])->one();
        //ngambil data checkbox
        $pengesah = ArrayHelper::map(Pengesah::find()->all(), 'nama_pengesah', 'nama_pengesah');
        if ($model->load(Yii::$app->request->post())) {
          $model->file_dokumen = UploadedFile::getInstance($model,'file_dokumen');
          $no_dokumen_temp = $model->find()->where(['format_dokumen'=>$kode])->orderBy(['no_dokumen'=>SORT_DESC])->one();
          $model->format_dokumen = $kode;

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

          $pengesah_temp = $model->pengesah;
          $model->pengesah = json_encode($pengesah_temp);
          $model->waktu_input = date("d-m-Y H:i:s");
          $model->id_user = Yii::$app->user->identity->id_user;
          $model->persetujuan = NULL;
          $model->ket_persetujuan = NULL;
          $model->save(false);
          if($model->file_dokumen != NULL)
          $model->file_dokumen->saveAs('uploads/' . $model->file_dokumen->baseName . '.' . $model->file_dokumen->extension);

            return $this->redirect(['view',
            'id'=>$model->id_sk_kepwakil_gub,
            'kode'=>$kode,
            'model'=>$model,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2,
                'dataPengesah'=>$pengesah,
            ]);
        }
    }

    /**
     * Updates an existing SkKepwakilGubSjalan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($kode,$id)
    {
        $jd = new Jenisdokumen();
        $temp_model = new TempSkKepwakilGub();
        $model = $this->findModel($id);
        $dataSk = $this->findModel($id);
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $data3 = $jd->find()->where(['kode_jenis_dokumen'=>$kode])->one();
        $pengesah = ArrayHelper::map(Pengesah::find()->all(), 'nama_pengesah', 'nama_pengesah');

        if ($model->load(Yii::$app->request->post())) {
        $temp_model->file_dokumen = UploadedFile::getInstance($model,'file_dokumen');

        if($temp_model->file_dokumen == NULL){
          $temp_model->file_dokumen = $dataSk->file_dokumen;
        }
        if(Yii::$app->user->identity->role->ket_role == 'Administrator')
        {
            $temp_model->no_dokumen = $model->no_dokumen;
        }else{
            $temp_model->no_dokumen = $dataSk->no_dokumen;
        }
          $temp_model->kode_tahun = $dataSk->kode_tahun;
          $temp_model->format_dokumen = $dataSk->format_dokumen;
          $temp_model->id_sk_kepwakil_gub = $dataSk->id_sk_kepwakil_gub;
          $pengesah_temp = $model->pengesah;
          $temp_model->pengesah = json_encode($pengesah_temp);
          $temp_model->perihal = $model->perihal;
          $temp_model->id_user = $dataSk->id_user;
          $temp_model->waktu_input = $dataSk->waktu_input;
          $temp_model->editor = Yii::$app->user->identity->nama_user;
        $this->actionBelum($kode,$id);
        $temp_model->save(false);
            if($temp_model->file_dokumen != $dataSk->file_dokumen){
            $temp_model->file_dokumen->saveAs('uploads/' . $temp_model->file_dokumen->baseName . '.' . $temp_model->file_dokumen->extension);}
            Yii::$app->getSession()->setFlash('success', [
           'text' => 'Update Telah Disimpan',
           'title' => 'Tersimpan',
           'type' => 'success',
           'timer' => 3000,
           'showConfirmButton' => true
       ]);
            return $this->redirect(['view',
              'id'=>$model->id_sk_kepwakil_gub,
              'kode'=>$kode,
              'model'=>$model,
              'dataJenisDokumen' => $data,
              'dataSifatDokumen' => $data2]);
        } else {
          $temp = json_decode($model->pengesah);
          $model->pengesah = $temp;
            return $this->render('update', [
              'model' => $model,
              'dataJenisDokumen' => $data,
              'dataSifatDokumen' => $data2,
              'dataPengesah'=>$pengesah,
              'kode'=>$data3,
            ]);
        }
    }

    /**
     * Deletes an existing SkKepwakilGubSjalan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($kode,$id)
    {
        $this->findModel($id)->delete();

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
     * Finds the SkKepwakilGubSjalan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SkKepwakilGubSjalan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SkKepwakilGub::findOne($id)) !== null) {
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
