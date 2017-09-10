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
use app\models\Hariliburtahunan;
use app\models\User;
use yii\filters\AccessControl;
use app\components\AccessRule;

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
        'access' => [
            'class' => AccessControl::className(),
            'ruleConfig' => [
                     'class' => AccessRule::className(),
                 ],
            'only' => ['logout','index','create','update','delete','view'],
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
     * Lists all SkKepwakilGubSjalan models.
     * @return mixed
     */
    public function actionIndex($kode)
    {
        $searchModel = new SkKepwakilGubSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$kode);
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $libur = Hariliburtahunan::find()->andWhere(['like','waktu_hari_libur',date('d-m-Y')])->one();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
            'libur'=>$libur
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
$libur = Hariliburtahunan::find()->andWhere(['like','waktu_hari_libur',date('d-m-Y')])->one();
        return $this->render('view', [
            'model' => $model,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
            'libur'=>$libur
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
          if(date('D')=='Sat'){
            $model->waktu_input = date('d-m-Y',strtotime('-1 day')).' '.date('H:i:s',strtotime('23:59:59'));
          }else if(date('D')=='Sun'){
            $model->waktu_input = date('d-m-Y',strtotime('-2 day')).' '.date('H:i:s',strtotime('23:59:59'));
          }else{
          $model->waktu_input = date("d-m-Y H:i:s");
          }
          $model->id_user = Yii::$app->user->identity->id_user;
          $model->penyetuju_dokumen=NULL;
          $model->ket_penyetuju_dokumen=NULL;
          $model->persetujuan_edit = NULL;
          $model->ket_persetujuan_edit = NULL;
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
            $temp_model->waktu_input = $model->waktu_input;
        }else{
            $temp_model->no_dokumen = $dataSk->no_dokumen;
            $temp_model->waktu_input = $dataSk->waktu_input;
        }
          $temp_model->kode_tahun = $dataSk->kode_tahun;
          $temp_model->format_dokumen = $dataSk->format_dokumen;
          $temp_model->id_sk_kepwakil_gub = $dataSk->id_sk_kepwakil_gub;
          $pengesah_temp = $model->pengesah;
          $temp_model->pengesah = json_encode($pengesah_temp);
          $temp_model->perihal = $model->perihal;
          $temp_model->id_user = $dataSk->id_user;

          $temp_model->editor = Yii::$app->user->identity->nama_user;
        $this->actionBelum($kode,$id);
        $temp_model->save(false);
            if($temp_model->file_dokumen != $dataSk->file_dokumen){
            $temp_model->file_dokumen->saveAs('uploads/' . $temp_model->file_dokumen->baseName . '.' . $temp_model->file_dokumen->extension);}
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
        Yii::$app->getSession()->setFlash('success', [
       'text' => 'Dokumen Telah Dihapus',
       'title' => 'Terhapus',
       'type' => 'success',
       'timer' => 3000,
       'showConfirmButton' => true
   ]);

        return $this->redirect(['index','kode'=>$kode]);
    }

    public function actionApprove($kode,$id)
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
      return $this->redirect(['index','kode'=>$kode,
      'dataJenisDokumen' => $data,
      'dataSifatDokumen' => $data2]);
    }

    public function actionBelum($kode,$id)
    {
        $model = $this->findModel($id);
        $model->persetujuan_edit = 'Belum Disetujui';
        $model->ket_persetujuan_edit=NULL;
        $model->penyetuju_dokumen = NULL;
        $model->ket_penyetuju_dokumen=NULL;
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
