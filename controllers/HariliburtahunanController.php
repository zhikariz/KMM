<?php

namespace app\controllers;

use Yii;
use app\models\Hariliburtahunan;
use app\models\HariliburtahunanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\User;
use yii\filters\AccessControl;
use app\components\AccessRule;

/**
 * HariliburtahunanController implements the CRUD actions for Hariliburtahunan model.
 */
class HariliburtahunanController extends Controller
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
                    'actions' => ['logout','index','create','update','delete','view'],
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
     * Lists all Hariliburtahunan models.
     * @return mixed
     */
    public function actionIndex()
    {
      $data = $this->getJenisDokumen();
      $data2 = $this->getSifatDokumen();
        $searchModel = new HariliburtahunanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2
        ]);
    }

    /**
     * Displays a single Hariliburtahunan model.
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
            'dataSifatDokumen' => $data2
        ]);
    }

    /**
     * Creates a new Hariliburtahunan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Hariliburtahunan();
        $data = $this->getJenisDokumen();
        $data2 = $this->getSifatDokumen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_hari_libur]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2
            ]);
        }
    }

    /**
     * Updates an existing Hariliburtahunan model.
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
            return $this->redirect(['view', 'id' => $model->id_hari_libur]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataJenisDokumen' => $data,
                'dataSifatDokumen' => $data2
            ]);
        }
    }

    /**
     * Deletes an existing Hariliburtahunan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      $data = $this->getJenisDokumen();
      $data2 = $this->getSifatDokumen();
        $this->findModel($id)->delete();

        return $this->redirect
        (
          [
            'index',
            'dataJenisDokumen' => $data,
            'dataSifatDokumen' => $data2
          ]
        );
    }

    /**
     * Finds the Hariliburtahunan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hariliburtahunan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hariliburtahunan::findOne($id)) !== null) {
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
