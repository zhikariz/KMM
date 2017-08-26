<?php

namespace app\controllers;

use Yii;
use app\models\TempSkKepwakilGub;
use app\models\TempSkKepwakilGubSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\SkKepwakilGub;

/**
 * TempskkepwakilgubController implements the CRUD actions for TempSkKepwakilGub model.
 */
class TempskkepwakilgubController extends Controller
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
     * Lists all TempSkKepwakilGub models.
     * @return mixed
     */
    public function actionIndex($kode)
    {
      $data = $this->getJenisDokumen();
      $data2 = $this->getSifatDokumen();
        $searchModel = new TempSkKepwakilGubSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$kode);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
        ]);
    }

    /**
     * Displays a single TempSkKepwakilGub model.
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
            'dataSifatDokumen' => $data2
        ]);
    }

    /**
     * Creates a new TempSkKepwakilGub model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TempSkKepwakilGub();
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_temp_sk_kep_wakil_gub]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2
            ]);
        }
    }

    /**
     * Updates an existing TempSkKepwakilGub model.
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
            return $this->redirect(['view', 'id' => $model->id_temp_sk_kep_wakil_gub]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2
            ]);
        }
    }

    /**
     * Deletes an existing TempSkKepwakilGub model.
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
        $model_sk = SkKepwakilGub::find()->where(['id_sk_kepwakil_gub'=>$model->id_sk_kepwakil_gub])->one();
        $model_sk->kode_tahun = $model->kode_tahun;
        $model_sk->no_dokumen = $model->no_dokumen;
        $model_sk->format_dokumen = $model->format_dokumen;
        $model_sk->perihal = $model->perihal;
        $model_sk->pengesah = $model->pengesah;
        $model_sk->id_user = $model->id_user;
        $model_sk->waktu_input = $model->waktu_input;
        $model_sk->file_dokumen = $model->file_dokumen;
        $model_sk->persetujuan = 'Disetujui';
        $model_sk->ket_persetujuan = 'Telah Disetujui Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
        if($model_sk->editor == null){
          $temp_editor = $model->editor;
            $model_sk->editor = $temp_editor;
        }else {
        $temp_editor = [$model_sk->editor,$model->editor];
          $model_sk->editor = implode(' , ',$temp_editor);
        }
        $model_sk->save();
        $this->findModel($id)->delete();
        return $this->redirect(['index','kode'=>$kode]);
    }

    public function actionReject($kode,$id)
    {
      $model = $this->findModel($id);
      $model_sk = SkKepwakilGub::find()->where(['id_sk_kepwakil_gub'=>$model->id_sk_kepwakil_gub])->one();
        $model_sk->persetujuan = 'Ditolak';
        $model_sk->ket_persetujuan = 'Telah Ditolak Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
        if($model_sk->editor == null){
          $temp_editor = $model->editor;
            $model_sk->editor = $temp_editor;
        }else {
        $temp_editor = [$model_sk->editor,$model->editor];
          $model_sk->editor = implode(' , ',$temp_editor);
        }
        $model_sk->save();
        $this->findModel($id)->delete();


        return $this->redirect(['index','kode'=>$kode]);
    }

    /**
     * Finds the TempSkKepwakilGub model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TempSkKepwakilGub the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TempSkKepwakilGub::findOne($id)) !== null) {
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
