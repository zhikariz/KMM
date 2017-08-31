<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\models\Tahun;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\Administratif;
use app\models\AdministratifSearch;
use app\models\Satuankerja;
use app\models\Unitkerja;
use app\models\Tim;
use app\models\Pengesah;
use app\models\TempAdm;
use yii\filters\AccessControl;
use app\components\AccessRule;
use app\models\User;
use app\models\Hariliburtahunan;


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
          'access' => [
              'class' => AccessControl::className(),
              'ruleConfig' => [
                       'class' => AccessRule::className(),
                   ],
              'only' => ['logout','index','create','update','delete','view','approve'],
              'rules' => [
                //nek wes login
                  [
                      'actions' => ['logout','create','update',],
                      'allow' => true,
                      'roles' => [
                        User::ROLE_ADMIN,
                        User::ROLE_OPERATOR,
                      ],
                  ],
                  [
                    'actions'=>['index','view'],
                    'allow'=>true,
                    'roles'=>[
                      User::ROLE_ADMIN,
                      User::ROLE_OPERATOR,
                      User::ROLE_APPROVAL,
                    ]
                  ],
                  [
                    'actions'=>['approve'],
                    'allow'=>true,
                    'roles'=>[
                      User::ROLE_APPROVAL,
                    ]
                  ],
                  [
                    'actions' => ['delete'],
                    'allow'=>true,
                    'roles'=>[
                      User::ROLE_ADMIN
                    ]
                  ]


                  //nek rung login
              ],
          ],
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
        $libur = Hariliburtahunan::find()->andWhere(['like','waktu_hari_libur',date('d-m-Y')])->one();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
            'kode'=>$data3,
            'sifat'=>$data4,
            'libur'=>$libur

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
      $libur = Hariliburtahunan::find()->andWhere(['like','waktu_hari_libur',date('d-m-Y')])->one();

        return $this->render('view', [
            'model' => $model,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
            'libur'=>$libur
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
            $temp_format = json_encode($model->format_dokumen);
            $model->format_dokumen = $temp_format;
            $no_dokumen_temp = $model->find()->where(['format_dokumen'=> $model->format_dokumen,'kode_jenis_dokumen'=>$kode,'kode_sifat_dokumen'=>$sifat])->orderBy(['no_dokumen'=>SORT_DESC])->one();

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
            if(date('D')=='Sat'){
              $model->waktu_input = date('d-m-Y',strtotime('-1 day')).' '.date('H:i:s',strtotime('23:59:59'));
            }else if(date('D')=='Sun'){
              $model->waktu_input = date('d-m-Y',strtotime('-2 day')).' '.date('H:i:s',strtotime('23:59:59'));
            }else{
            $model->waktu_input = date("d-m-Y H:i:s");
            }

            $model->id_user = Yii::$app->user->identity->id_user;
            $model->kode_jenis_dokumen = $kode;
            $model->kode_sifat_dokumen = $sifat;
            $model->penyetuju_dokumen=NULL;
            $model->ket_penyetuju_dokumen=NULL;
            $model->persetujuan_edit = NULL;
            $model->ket_persetujuan_edit=NULL;

            $model->save();
            if($model->file_dokumen != NULL)
            $model->file_dokumen->saveAs('uploads/' . $model->file_dokumen->baseName . '.' . $model->file_dokumen->extension);
            Yii::$app->getSession()->setFlash('success', [
           'text' => 'Dokumen Telah Disimpan',
           'title' => 'Tersimpan',
           'type' => 'success',
           'timer' => 3000,
           'showConfirmButton' => true
       ]);
            return $this->redirect(['view',
            'kode'=>$kode,
            'sifat'=>$sifat,
            'id'=>$model->id_surat_adm,
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
        $temp_model = new TempAdm();
        $jd = new Jenisdokumen();
        $dataAdm = $this->findModel($id);
        //$dataAdm = Administratif::find()->where(['kode_jenis_dokumen'=>$kode,'kode_sifat_dokumen'=>$sifat])->one();
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
          $temp_model->file_dokumen = UploadedFile::getInstance($model,'file_dokumen');
          if($temp_model->file_dokumen == NULL){
            $temp_model->file_dokumen = $dataAdm->file_dokumen;
          }
          if(Yii::$app->user->identity->role->ket_role == 'Administrator')
          {
            $temp_format = json_encode($model->format_dokumen);
            $temp_model->format_dokumen = $temp_format;
              $temp_model->no_dokumen = $model->no_dokumen;
          }else{
              $temp_model->format_dokumen = $dataAdm->format_dokumen;
              $temp_model->no_dokumen = $dataAdm->no_dokumen;
          }
          $temp_model->id_surat_adm = $model->id_surat_adm;
          $temp_model->kode_tahun = $dataAdm->kode_tahun;

          $pengesah_temp = $model->pengesah;
          $temp_model->pengesah = json_encode($pengesah_temp);
          $temp_model->waktu_input = $dataAdm->waktu_input;
          $temp_model->id_user = $dataAdm->id_user;
          $temp_model->kode_jenis_dokumen = $kode;
          $temp_model->kode_sifat_dokumen = $sifat;
          $temp_model->perihal = $model->perihal;
          $temp_model->editor = Yii::$app->user->identity->nama_user;
          $this->actionBelum($kode,$sifat,$id);

          $temp_model->save(false);
          if($temp_model->file_dokumen != $dataAdm->file_dokumen){
          $temp_model->file_dokumen->saveAs('uploads/' . $temp_model->file_dokumen->baseName . '.' . $temp_model->file_dokumen->extension);
        }
        if(Yii::$app->user->identity->role->ket_role == 'Operator'){
        Yii::$app->getSession()->setFlash('success', [
       'text' => 'Dokumen Selesai Terupdate Silahkan Tunggu Approval Untuk Menyetujui',
       'title' => 'Proses Update',
       'type' => 'success',
       'timer' => 3000,
       'showConfirmButton' => true
   ]);
 }else{
   Yii::$app->getSession()->setFlash('success', [
  'text' => 'Dokumen Selesai Terupdate Silahkan Tunggu Admin Approval Lain Untuk Menyetujui',
  'title' => 'Proses Update',
  'type' => 'success',
  'timer' => 3000,
  'showConfirmButton' => true
]);

 }
            return $this->redirect(['view', 'model'=>$model,'kode'=>$kode,'sifat'=>$sifat,'id'=>$model->id_surat_adm,'id' => $model->id_surat_adm,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2]);

        } else {
          $temp = json_decode($model->format_dokumen,true);
          $model->format_dokumen = $temp;
          $temp_model_pengesah = json_decode($model->pengesah,true);
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
        Yii::$app->getSession()->setFlash('success', [
       'text' => 'Dokumen Telah Terhapus',
       'title' => 'Terhapus',
       'type' => 'success',
       'timer' => 3000,
       'showConfirmButton' => true
   ]);
        return $this->redirect(['index','kode'=>$kode,'sifat'=>$sifat,
        'dataJenisDokumen' => $data,
        'dataSifatDokumen' => $data2]);
    }

    public function actionApprove($kode,$sifat,$id)
    {
      $model= $this->findModel($id);
      $data = $this->getJenisDokumen();
      $data2 = $this->getSifatDokumen();
      if($model->penyetuju_dokumen == NULL){
        $user[] = Yii::$app->user->identity->nama_user;
        $model->penyetuju_dokumen = json_encode($user);
        $format[] = 'Telah Disetujui Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
        $model->ket_penyetuju_dokumen = json_encode($format);
      }else{
        $temp = json_decode($model->penyetuju_dokumen,true);
          array_push($temp,Yii::$app->user->identity->nama_user);
        $model->penyetuju_dokumen = json_encode($temp);

        $temp_ket = json_decode($model->ket_penyetuju_dokumen,true);
        $format2 = 'Telah Disetujui Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
        array_push($temp_ket,$format2);
        $model->ket_penyetuju_dokumen = json_encode($temp_ket);
      }
      $model->save();


      Yii::$app->getSession()->setFlash('success', [
     'text' => 'Dokumen Telah Disetujui',
     'title' => 'Berhasil',
     'type' => 'success',
     'timer' => 3000,
     'showConfirmButton' => true
      ]);
      return $this->redirect(['index','kode'=>$kode,'sifat'=>$sifat,
      'dataJenisDokumen' => $data,
      'dataSifatDokumen' => $data2]);
    }

    public function actionBelum($kode,$sifat,$id)
    {
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $model = $this->findModel($id);

        $model->persetujuan_edit = 'Belum Disetujui';
        $model->penyetuju_dokumen = NULL;
        $model->ket_penyetuju_dokumen = NULL;
        $model->ket_persetujuan_edit=NULL;
          $model->save();
          return null;
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
