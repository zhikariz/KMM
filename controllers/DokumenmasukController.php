<?php

namespace app\controllers;

use Yii;
use app\models\Dokumenmasuk;
use app\models\DokumenmasukSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\Tim;
use app\models\Unitkerja;
use app\models\Petunjuk;
use app\models\Pejabat;
use yii\web\UploadedFile;
use app\models\TempDokumenMasuk;
use app\models\Hariliburtahunan;
use app\models\User;
use yii\filters\AccessControl;
use app\components\AccessRule;

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
     * Lists all Dokumenmasuk models.
     * @return mixed
     */
    public function actionIndex($sifat)
    {

        $searchModel = new DokumenmasukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$sifat);
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $libur = Hariliburtahunan::find()->andWhere(['like','waktu_hari_libur',date('d-m-Y')])->one();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
            'libur'=>$libur,
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
      $data_dokumen_masuk = Dokumenmasuk::find()->where(['kode_sifat_dokumen'=>$sifat,'id_dokumen_masuk'=>$id])->one();
      $libur = Hariliburtahunan::find()->andWhere(['like','waktu_hari_libur',date('d-m-Y')])->one();
        return $this->render('view', [
            'model' => $model,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
            'dataDokumenMasuk' => $data_dokumen_masuk,
            'libur'=>$libur,
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
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        //ngambil data checkbox
        $dataKepala = ArrayHelper::map(Pejabat::find()->all(), 'nama_deputi', 'nama_deputi');
        $dataUnit = ArrayHelper::map(Unitkerja::find()->all(), 'ket_unit_kerja', 'ket_unit_kerja');
        $dataPetunjuk= ArrayHelper::map(Petunjuk::find()->all(), 'keterangan_petunjuk', 'keterangan_petunjuk');

        if ($model->load(Yii::$app->request->post())) {
          $temp = json_encode($model->tujuan_disposisi);
          $model->tujuan_disposisi = $temp;

          $temp2 = json_encode($model->petunjuk_disposisi);
          $model->petunjuk_disposisi = $temp2;

          $model->file_dokumen = UploadedFile::getInstance($model,'file_dokumen');


          $model->kode_sifat_dokumen = $sifat;
          if(date('D')=='Sat'){
            $model->waktu_input = date('d-m-Y',strtotime('-1 day')).' '.date('H:i:s',strtotime('23:59:59'));
          }else if(date('D')=='Sun'){
            $model->waktu_input = date('d-m-Y',strtotime('-2 day')).' '.date('H:i:s',strtotime('23:59:59'));
          }else{
          $model->waktu_input = date("d-m-Y H:i:s");
          }
          $model->id_user = Yii::$app->user->identity->id_user;
          $model->persetujuan = NULL;
          $model->ket_persetujuan = NULL;
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
            return $this->redirect(['view','sifat'=>$sifat,'id' => $model->id_dokumen_masuk,'model' => $model,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2,
                'dataUnit'=>$dataUnit,
                'dataKepala'=>$dataKepala,
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
    public function actionUpdate($sifat,$id)
    {
        $model = $this->findModel($id);
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $dataMasuk = $this->findModel($id);
        $dataKepala = ArrayHelper::map(Pejabat::find()->all(), 'nama_deputi', 'nama_deputi');
        $dataUnit = ArrayHelper::map(Unitkerja::find()->all(), 'ket_unit_kerja', 'ket_unit_kerja');
        $dataPetunjuk= ArrayHelper::map(Petunjuk::find()->all(), 'keterangan_petunjuk', 'keterangan_petunjuk');
        $temp_model = new TempDokumenMasuk();

        if ($model->load(Yii::$app->request->post())) {
          $temp_model->id_dokumen_masuk = $dataMasuk->id_dokumen_masuk;
          $temp_model->no_dokumen = $model->no_dokumen;
          $temp_model->tgl_dokumen = $model->tgl_dokumen;
          $temp_model->perihal = $model->perihal;
          $temp_model->asal_dokumen = $model->asal_dokumen;
          $temp_model->tgl_terima = $model->tgl_terima;
          $temp_model->kode_sifat_dokumen = $sifat;
          $temp_model->kesegeraan = $model->kesegeraan;
          $temp_model->dari = $model->dari;
          $temp = json_encode($model->tujuan_disposisi);
          $temp_model->tujuan_disposisi = $temp;
          $temp2 = json_encode($model->petunjuk_disposisi);
          $temp_model->petunjuk_disposisi = $temp2;
          $temp_model->ket_disposisi_kepala = $model->ket_disposisi_kepala;
          $temp_model->ket_disposisi_tim = $model->ket_disposisi_tim;
          $temp_model->ket_disposisi_unit = $model->ket_disposisi_unit;

          $temp_model->file_dokumen = UploadedFile::getInstance($model,'file_dokumen');

          if($temp_model->file_dokumen == NULL){
            $temp_model->file_dokumen = $dataMasuk->file_dokumen;
          }
          $temp_model->waktu_input = $dataMasuk->waktu_input;
          $temp_model->id_user = $dataMasuk->id_user;
          $temp_model->editor = Yii::$app->user->identity->nama_user;
          $temp_model->save(false);
          $this->actionBelum($sifat,$id);
          if($temp_model->file_dokumen != $dataMasuk->file_dokumen)
          $temp_model->file_dokumen->saveAs('uploads/' . $temp_model->file_dokumen->baseName . '.' . $temp_model->file_dokumen->extension);
          Yii::$app->getSession()->setFlash('success', [
         'text' => 'Dokumen Selesai Terupdate Silahkan Tunggu Approval Untuk Menyetujui',
         'title' => 'Proses Update',
         'type' => 'success',
         'timer' => 3000,
         'showConfirmButton' => true
     ]);
          return $this->redirect(['view','sifat'=>$sifat,'id' => $model->id_dokumen_masuk,'model' => $model,
          'dataJenisDokumen' => $data,
          'dataSifatDokumen' => $data2,]);
        } else {
          $temp = json_decode($model->tujuan_disposisi,true);
          $model->tujuan_disposisi = $temp;
          $temp2 = json_decode($model->petunjuk_disposisi,true);
          $model->petunjuk_disposisi = $temp2;
            return $this->render('update', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2,
                'dataUnit'=>$dataUnit,
                'dataKepala'=>$dataKepala,
                'dataPetunjuk'=>$dataPetunjuk
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
        Yii::$app->getSession()->setFlash('success', [
       'text' => 'Dokumen Telah Terhapus',
       'title' => 'Terhapus',
       'type' => 'success',
       'timer' => 3000,
       'showConfirmButton' => true
   ]);

        return $this->redirect(['index','sifat'=>$sifat]);
    }



    public function actionBelum($sifat,$id)
    {
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $model = $this->findModel($id);

          $model->persetujuan = 'Belum Disetujui';
        $model->ket_persetujuan=NULL;
          $model->save();
          return null;
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
