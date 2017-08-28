<?php

namespace app\controllers;

use Yii;
use app\models\TempDokumenMasuk;
use app\models\TempDokumenMasukSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\Dokumenmasuk;

/**
 * TempdokumenmasukController implements the CRUD actions for TempDokumenMasuk model.
 */
class TempdokumenmasukController extends Controller
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
     * Lists all TempDokumenMasuk models.
     * @return mixed
     */
    public function actionIndex($sifat)
    {
        $searchModel = new TempDokumenMasukSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$sifat);
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
     * Displays a single TempDokumenMasuk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $data = $this->getJenisDokumen();
      $data2 = $this->getSifatDokumen();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2,
        ]);
    }

    /**
     * Creates a new TempDokumenMasuk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TempDokumenMasuk();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_temp_dokumen_masuk]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2,
            ]);
        }
    }

    /**
     * Updates an existing TempDokumenMasuk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_temp_dokumen_masuk]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2,
            ]);
        }
    }

    public function actionApprove($sifat,$id)
    {
        $model = $this->findModel($id);
        $model_masuk = Dokumenmasuk::find()->where(['kode_sifat_dokumen'=>$sifat,'id_dokumen_masuk'=>$model->id_dokumen_masuk])->one();
        $model_masuk->no_dokumen = $model->no_dokumen;
        $model_masuk->tgl_dokumen = $model->tgl_dokumen;
        $model_masuk->perihal = $model->perihal;
        $model_masuk->asal_dokumen = $model->asal_dokumen;
        $model_masuk->tgl_terima = $model->tgl_terima;
        $model_masuk->kode_sifat_dokumen = $model->kode_sifat_dokumen;
        $model_masuk->kesegeraan = $model->kesegeraan;
        $model_masuk->dari = $model->dari;
        $model_masuk->tujuan_disposisi = $model->tujuan_disposisi;
        $model_masuk->petunjuk_disposisi = $model->petunjuk_disposisi;
        $model_masuk->ket_disposisi_kepala = $model->ket_disposisi_kepala;
        $model_masuk->ket_disposisi_tim = $model->ket_disposisi_tim;
        $model_masuk->ket_disposisi_unit = $model->ket_disposisi_unit;
        $model_masuk->file_dokumen = $model->file_dokumen;
        $model_masuk->id_user = $model->id_user;
        $model_masuk->waktu_input = $model->waktu_input;
        $model_masuk->persetujuan = 'Disetujui';
        $model_masuk->ket_persetujuan = 'Telah Disetujui Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
        if($model_masuk->editor == null){
          $temp_editor = $model->editor;
          $model_masuk->editor = $temp_editor;
        }else{
          $temp_editor = [$model_masuk->editor,$model->editor];
          $model_masuk->editor = implode(' , ',$temp_editor);
        }
        $model_masuk->save();
        $this->findModel($id)->delete();

        return $this->redirect(['index','sifat'=>$sifat]);
    }

    public function actionReject($sifat,$id)
    {
      $model = $this->findModel($id);
      $model_masuk = Dokumenmasuk::find()->where(['kode_sifat_dokumen'=>$sifat,'id_dokumen_masuk'=>$model->id_dokumen_masuk])->one();
        $model_masuk->persetujuan = 'Ditolak';
        $model_masuk->ket_persetujuan = 'Telah Ditolak Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
        if($model_masuk->editor == null){
          $temp_editor = $model->editor;
          $model_masuk->editor = $temp_editor;
        }else{
          $temp_editor = [$model_masuk->editor,$model->editor];
          $model_masuk->editor = implode(' , ',$temp_editor);
        }
        $model->save();
        $this->findModel($id)->delete();

        return $this->redirect(['index','sifat'=>$sifat]);
    }

    /**
     * Deletes an existing TempDokumenMasuk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TempDokumenMasuk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TempDokumenMasuk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TempDokumenMasuk::findOne($id)) !== null) {
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
