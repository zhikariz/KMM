<?php

namespace app\controllers;

use Yii;
use app\models\TempNotaDebet;
use app\models\TempNotaDebetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\Notadebet;
use app\models\User;
use yii\filters\AccessControl;
use app\components\AccessRule;
/**
 * TempnotadebetController implements the CRUD actions for TempNotaDebet model.
 */
class TempnotadebetController extends Controller
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
     * Lists all TempNotaDebet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TempNotaDebetSearch();
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
     * Displays a single TempNotaDebet model.
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
     * Creates a new TempNotaDebet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TempNotaDebet();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_temp_nota_debet]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TempNotaDebet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_temp_nota_debet]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TempNotaDebet model.
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
      $model_nota = Notadebet::find()->where(['id_nota_debet'=>$model->id_nota_debet])->one();
        $model_nota->kode_tahun = $model->kode_tahun;
        $model_nota->no_dokumen = $model->no_dokumen;
        $model_nota->kode_satuan_kerja = $model->kode_satuan_kerja;
        $model_nota->kode_satker_pusat = $model->kode_satker_pusat;
        $model_nota->pengesah = $model->pengesah;
        $model_nota->perihal = $model->perihal;
        $model_nota->id_user = $model->id_user;
        $model_nota->waktu_input = $model->waktu_input;
        $model_nota->file_dokumen = $model->file_dokumen;
        $model_nota->persetujuan_edit = 'Disetujui';
        $model_nota->ket_persetujuan_edit = 'Telah Disetujui Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
        if($model_nota->editor == null){
          $temp_editor = $model->editor;
          $model_nota->editor = $temp_editor;
        }else{
          $temp_editor = [$model_nota->editor,$model->editor];
          $model_nota->editor = implode(' , ',$temp_editor);
        }
        $model_nota->save();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionReject($id)
    {
      $model = $this->findModel($id);
      $model_nota = Notadebet::find()->where(['id_nota_debet'=>$model->id_nota_debet])->one();
        $model_nota->persetujuan_edit = 'Ditolak';
        $model_nota->ket_persetujuan_edit = 'Telah Ditolak Pada '. date("d-m-Y H:i:s") . ' Oleh '. Yii::$app->user->identity->nama_user;
        if($model_nota->editor == null){
          $temp_editor = $model->editor;
          $model_nota->editor = $temp_editor;
        }else{
          $temp_editor = [$model_nota->editor,$model->editor];
          $model_nota->editor = implode(' , ',$temp_editor);
        }
        $model_nota->save();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TempNotaDebet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TempNotaDebet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TempNotaDebet::findOne($id)) !== null) {
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
