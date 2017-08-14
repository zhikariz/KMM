<?php

namespace app\controllers;

use Yii;
use app\models\Notadebet;
use app\models\NotadebetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\Pengesah;
use app\models\Tahun;
use app\models\Satuankerja;
use app\models\Satkerpusat;
use yii\web\UploadedFile;

/**
 * NotadebetController implements the CRUD actions for Notadebet model.
 */
class NotadebetController extends Controller
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
     * Lists all Notadebet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotadebetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $dataNota = Notadebet::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
            'dataNota' => $dataNota,
        ]);
    }

    /**
     * Displays a single Notadebet model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
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
     * Creates a new Notadebet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notadebet();
        $tahun = new Tahun();
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();

        //tahun dari db
        $tahun_db = $tahun->find()->orderBy(['tahun'=>SORT_DESC])->one();
        //tahun sekarang
        $tahun_skr = date('Y');
        //ngambil data drop down
        $satker = ArrayHelper::map(Satuankerja::find()->all(), 'kode_satuan_kerja', 'ket_satuan_kerja');
        $satkerPusat = ArrayHelper::map(Satkerpusat::find()->all(), 'kode_satker_pusat', 'ket_satker_pusat');
        //ngambil data checkbox
        $pengesah = ArrayHelper::map(Pengesah::find()->all(), 'nama_pengesah', 'nama_pengesah');
        if ($model->load(Yii::$app->request->post()) ) {
            $model->file_dokumen = UploadedFile::getInstance($model,'file_dokumen');
            $no_dokumen_temp = $model->find()->orderBy(['no_dokumen'=>SORT_DESC])->one();

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
            $model->persetujuan = 'Belum Disetujui';
            $model->ket_persetujuan=NULL;

            $model->save();
            if($model->file_dokumen != NULL)
            $model->file_dokumen->saveAs('uploads/' . $model->file_dokumen->baseName . '.' . $model->file_dokumen->extension);
            return $this->redirect(['view', 'id' => $model->id_nota_debet]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2,
                'dataSatker'=>$satker,
                'dataSatkerPusat'=>$satkerPusat,
                'dataPengesah'=>$pengesah,
            ]);
        }
    }

    /**
     * Updates an existing Notadebet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dataNota = $this->findModel($id);
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        //ngambil data drop down
        $satker = ArrayHelper::map(Satuankerja::find()->all(), 'kode_satuan_kerja', 'ket_satuan_kerja');
        $satkerPusat = ArrayHelper::map(Satkerpusat::find()->all(), 'kode_satker_pusat', 'ket_satker_pusat');
        //ngambil data checkbox
        $pengesah = ArrayHelper::map(Pengesah::find()->all(), 'nama_pengesah', 'nama_pengesah');

        if ($model->load(Yii::$app->request->post()) ) {
          $model->file_dokumen = UploadedFile::getInstance($model,'file_dokumen');

          if($model->file_dokumen == NULL){
            $model->file_dokumen = $dataNota->file_dokumen;
          }
          $pengesah_temp = $model->pengesah;
          $model->pengesah = json_encode($pengesah_temp);
          $model->persetujuan = 'Belum Disetujui';
          $model->ket_persetujuan=NULL;
            $model->save();
            if($model->file_dokumen != $dataNota->file_dokumen){
            $model->file_dokumen->saveAs('uploads/' . $model->file_dokumen->baseName . '.' . $model->file_dokumen->extension);}
            return $this->redirect(['view', 'id' => $model->id_nota_debet]);
        } else {
          $temp = json_decode($model->pengesah);
          $model->pengesah = $temp;
            return $this->render('update', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2,
                'dataSatker'=>$satker,
                'dataSatkerPusat'=>$satkerPusat,
                'dataPengesah'=>$pengesah,
            ]);
        }
    }

    /**
     * Deletes an existing Notadebet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionApprove($id)
    {
      $model = $this->findModel($id);
        $model->persetujuan = 'Disetujui';
        $model->ket_persetujuan = 'Telah Disetujui Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
        $model->save();

        return $this->redirect(['index']);
    }

    public function actionReject($id)
    {
      $model = $this->findModel($id);
        $model->persetujuan = 'Ditolak';
        $model->ket_persetujuan = 'Telah Ditolak Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notadebet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notadebet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notadebet::findOne($id)) !== null) {
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
