<?php

namespace app\controllers;

use Yii;
use app\models\Administratif;
use app\models\TempAdm;
use app\models\TempAdmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;

/**
 * TempadmController implements the CRUD actions for TempAdm model.
 */
class TempadmController extends Controller
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
     * Lists all TempAdm models.
     * @return mixed
     */
    public function actionIndex($kode,$sifat)
    {
        $searchModel = new TempAdmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$kode,$sifat);
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $data_adm = TempAdm::find()->where(['kode_jenis_dokumen'=>$kode,'kode_sifat_dokumen'=>$sifat])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
            'dataAdm'=>$data_adm,
        ]);
    }

    /**
     * Displays a single TempAdm model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$kode,$sifat)
    {
      $data = $this->getJenisDokumen();
      $data2 = $this->getSifatDokumen();
      $model=$this->findModel($id);
      $temp=json_decode($model->pengesah,true);
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
     * Creates a new TempAdm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TempAdm();
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_temp_adm]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2
            ]);
        }
    }

    /**
     * Updates an existing TempAdm model.
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
            return $this->redirect(['view', 'id' => $model->id_temp_adm]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2
            ]);
        }
    }

    /**
     * Deletes an existing TempAdm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($kode,$sifat,$id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index','kode'=>$kode,'sifat'=>$sifat,]);
    }

    public function actionApprove($kode,$sifat,$id)
    {
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $model = $this->findModel($id);
        $model_adm = Administratif::find()->where(['id_surat_adm'=>$model->id_surat_adm])->one();
          $model_adm->no_dokumen = $model->no_dokumen;
          $model_adm->kode_tahun = $model->kode_tahun;
          $model_adm->format_dokumen = $model->format_dokumen;
          $model_adm->pengesah = $model->pengesah;
          $model_adm->kode_jenis_dokumen = $model->kode_jenis_dokumen;
          $model_adm->kode_sifat_dokumen = $model->kode_sifat_dokumen;
          $model_adm->perihal = $model->perihal;
          $model_adm->id_user = $model->id_user;
          $model_adm->waktu_input = $model->waktu_input;
          $model_adm->file_dokumen = $model->file_dokumen;
          $temp_editor = $model_adm->editor;
          $model_adm->editor = $temp_editor . ',' . $model->editor;
          $model_adm->persetujuan = 'Disetujui';
          $model_adm->ket_persetujuan = 'Telah Disetujui Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
          $model_adm->save();
          $this->findModel($id)->delete();
          return $this->redirect(['index','kode'=>$kode,'sifat'=>$sifat,
          'dataJenisDokumen' => $data,
          'dataSifatDokumen' => $data2]);


    }

    public function actionReject($kode,$sifat,$id)
    {
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();
        $model = $this->findModel($id);
        $model_adm = Administratif::find()->where(['id_surat_adm'=>$model->id_surat_adm])->one();
          $model_adm->persetujuan = 'Ditolak';
          $model_adm->ket_persetujuan = 'Telah Ditolak Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
          $model_adm->save();
          $this->findModel($id)->delete();
        return $this->redirect(['index','kode'=>$kode,'sifat'=>$sifat,
        'dataJenisDokumen' => $data,
        'dataSifatDokumen' => $data2]);
    }

    /**
     * Finds the TempAdm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TempAdm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TempAdm::findOne($id)) !== null) {
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
