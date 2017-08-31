<?php

namespace app\controllers;

use Yii;
use app\models\TempSuratjalan;
use app\models\TempSuratjalanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\Suratjalan;
use app\models\User;
use yii\filters\AccessControl;
use app\components\AccessRule;

/**
 * TempsuratjalanController implements the CRUD actions for TempSuratjalan model.
 */
class TempsuratjalanController extends Controller
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
            'only' => ['logout','index','create','update','delete','view','approve','reject'],
            'rules' => [
              //nek wes login
                [
                    'actions' => ['logout','index','create','update','delete','view','approve','reject'],
                    'allow' => true,
                    'roles' => [
                      User::ROLE_ADMIN,
                    ],
                ],

                ]


                //nek rung login
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
     * Lists all TempSuratjalan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TempSuratjalanSearch();
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
     * Displays a single TempSuratjalan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
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
            'dataSifatDokumen' => $data2
        ]);
    }

    /**
     * Creates a new TempSuratjalan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TempSuratjalan();
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_temp_suratjalan]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2
            ]);
        }
    }

    /**
     * Updates an existing TempSuratjalan model.
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
            return $this->redirect(['view', 'id' => $model->id_temp_suratjalan]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2
            ]);
        }
    }

    /**
     * Deletes an existing TempSuratjalan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionApprove($kode,$id)
    {
      $model = $this->findModel($id);
      $model_surat = Suratjalan::find()->where(['id_surat_jalan'=>$model->id_surat_jalan])->one();
      $model_surat->kode_tahun = $model->kode_tahun;
      $model_surat->kode_satuan_kerja = $model->kode_satuan_kerja;
      $model_surat->no_dokumen = $model->no_dokumen;
      $model_surat->format_dokumen = $model->format_dokumen;
      $model_surat->pengesah = $model->pengesah;
      $model_surat->id_user = $model->id_user;
      $model_surat->waktu_input = $model->waktu_input;
      $model_surat->file_dokumen = $model->file_dokumen;
      $model_surat->persetujuan_edit = 'Disetujui';
      $model_surat->ket_persetujuan_edit = 'Telah Disetujui Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
      if($model_surat->editor == null){
        $temp_editor = $model->editor;
          $model_surat->editor = $temp_editor;
      }else {
      $temp_editor = [$model_surat->editor,$model->editor];
        $model_surat->editor = implode(' , ',$temp_editor);
      }
        $model_surat->save();
        $this->findModel($id)->delete();

        return $this->redirect(['index','kode'=>$kode]);
    }

    public function actionReject($kode,$id)
    {
      $model = $this->findModel($id);
      $model_surat = Suratjalan::find()->where(['id_surat_jalan'=>$model->id_surat_jalan])->one();
      if($model_surat->editor == null){
        $temp_editor = $model->editor;
          $model_surat->editor = $temp_editor;
      }else {
      $temp_editor = [$model_surat->editor,$model->editor];
        $model_surat->editor = implode(' , ',$temp_editor);
      }
        $model_surat->persetujuan_edit = 'Ditolak';
        $model_surat->ket_persetujuan_edit = 'Telah Ditolak Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
        $model_surat->save();
        $this->findModel($id)->delete();

        return $this->redirect(['index','kode'=>$kode]);
    }

    /**
     * Finds the TempSuratjalan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TempSuratjalan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TempSuratjalan::findOne($id)) !== null) {
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
