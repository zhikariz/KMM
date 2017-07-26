<?php

namespace app\controllers;

use Yii;
use app\models\Tahun;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\Administratif;
use app\models\AdministratifSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Satuankerja;
use app\models\Unitkerja;
use app\models\Tim;
use app\models\Pengesah;
use yii\web\UploadedFile;

/**
 * AdministratifController implements the CRUD actions for Administratif model.
 */
class AdministratifController extends Controller
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
     * Lists all Administratif models.
     * @return mixed
     */
    public function actionIndex($kode,$sifat)
    {
        $searchModel = new AdministratifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$kode,$sifat);
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $jd = new Jenisdokumen();
        $sd = new Sifatdokumen();
        $data3 = $jd->find()->where(['kode_jenis_dokumen'=>$kode])->one();
        $data4 = $sd->find()->where(['kode_sifat_dokumen'=>$sifat])->one();
        $data_adm = Administratif::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
            'kode'=>$data3,
            'sifat'=>$data4,
            'dataAdm'=>$data_adm,

        ]);
    }

    /**
     * Displays a single Administratif model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($kode,$sifat,$id)
    {
      $data = $this->getJenisDokumen();
      $data2 = $this->getSifatDokumen();
      $model=$this->findModel($id);
     $temp=json_decode($model->pengesah);
      $vl = implode(",",$temp);
      $model->pengesah = $vl;
        return $this->render('view', [
            'model' => $model,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2
        ]);
    }

    /**
     * Creates a new Administratif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($kode,$sifat)
    {
        $model = new Administratif();
        $tahun = new Tahun();
        $jd = new Jenisdokumen();
        //tahun dari db
        $tahun_db = $tahun->find()->orderBy(['tahun'=>SORT_DESC])->one();
        //tahun sekarang
        $tahun_skr = date('Y');

        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        //ngambil data jenis dokumen berdasarkan kode
        $data3 = $jd->find()->where(['kode_jenis_dokumen'=>$kode])->one();
        //ngambil data drop down
        $satker = ArrayHelper::map(Satuankerja::find()->all(), 'kode_satuan_kerja', 'ket_satuan_kerja');
        $unit = ArrayHelper::map(Unitkerja::find()->all(), 'kode_unit_kerja', 'ket_unit_kerja');
        $tim = ArrayHelper::map(Tim::find()->all(), 'kode_tim', 'nama_tim');
        //ngambil data checkbox
        $pengesah = ArrayHelper::map(Pengesah::find()->all(), 'nama_pengesah', 'nama_pengesah');
        //jika di submit
        if ($model->load(Yii::$app->request->post())) {

            $model->file_dokumen = UploadedFile::getInstance($model,'file_dokumen');
            $jml_jenis_dokumen = count(json_decode($data3->format_jenis_dokumen));

            if($jml_jenis_dokumen == 1){
              foreach($model->format_dokumen as $i){
              $temp[] = $i;
            }
              $model->format_dokumen = $temp[0];
            }else if($jml_jenis_dokumen == 2){
              foreach($model->format_dokumen as $i){
              $temp[] = $i;
            }
              $model->format_dokumen = $temp[0]."-".$temp[1];
            }else{
              foreach($model->format_dokumen as $i){
              $temp[] = $i;
            }
              $model->format_dokumen = $temp[0]."-".$temp[1]."-".$temp[2];
            }
            $no_dokumen_temp = $model->find()->where(['format_dokumen'=> $model->format_dokumen,'kode_jenis_dokumen'=>$kode,'kode_sifat_dokumen'=>$sifat])->orderBy(['no_dokumen'=>SORT_DESC])->one();

            if($tahun_skr != $tahun_db['tahun'] && $no_dokumen_temp['format_dokumen'] == $model->format_dokumen){
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
            $model->kode_jenis_dokumen = $kode;
            $model->kode_sifat_dokumen = $sifat;

            $model->save();
            $model->file_dokumen->saveAs('uploads/' . $model->file_dokumen->baseName . '.' . $model->file_dokumen->extension);

            return $this->redirect(['view','kode'=>$kode,'sifat'=>$sifat,'id'=>$model->id_surat_adm,
              'model'=>$model,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
          ]);
        } else {

            return $this->render('create', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2,
                'dataFormatJenis'=>$data3,
                'dataSatker'=>$satker,
                'dataUnit' => $unit,
                'dataTim' => $tim,
                'dataPengesah' => $pengesah,
            ]);
        }
    }

    /**
     * Updates an existing Administratif model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($kode,$sifat,$id)
    {
        $model = $this->findModel($id);
        $tahun = new Tahun();
        $jd = new Jenisdokumen();
        $data3 = $jd->find()->where(['kode_jenis_dokumen'=>$kode])->one();

        $jml_jenis_dokumen = count(json_decode($data3->format_jenis_dokumen));

        //ngambil data drop down
        $satker = ArrayHelper::map(Satuankerja::find()->all(), 'kode_satuan_kerja', 'ket_satuan_kerja');
        $unit = ArrayHelper::map(Unitkerja::find()->all(), 'kode_unit_kerja', 'ket_unit_kerja');
        $tim = ArrayHelper::map(Tim::find()->all(), 'kode_tim', 'nama_tim');
        //ngambil data checkbox
        $pengesah = ArrayHelper::map(Pengesah::find()->all(), 'nama_pengesah', 'nama_pengesah');

        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();

        if ($model->load(Yii::$app->request->post()) ) {
            return $this->redirect(['view', 'kode'=>$kode,'sifat'=>$sifat,'id'=>$model->id_surat_adm,'id' => $model->id_surat_adm,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2]);
                      $model->save();
        } else {
          $temp_model_pengesah = json_decode($model->pengesah);


          $model->pengesah = $temp_model_pengesah;


            return $this->render('update', [
              'model' => $model,
              'dataJenisDokumen' => $data,
              'dataSifatDokumen' => $data2,
              'dataFormatJenis'=>$data3,
              'dataSatker'=>$satker,
              'dataUnit' => $unit,
              'dataTim' => $tim,
              'dataPengesah' => $pengesah,
            ]);
        }
    }

    /**
     * Deletes an existing Administratif model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($kode,$sifat,$id)
    {
        $this->findModel($id)->delete();
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        return $this->redirect(['index','kode'=>$kode,'sifat'=>$sifat,
        'dataJenisDokumen' => $data,
        'dataSifatDokumen' => $data2]);
    }

    /**
     * Finds the Administratif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Administratif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Administratif::findOne($id)) !== null) {
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
