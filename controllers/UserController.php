<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use app\components\AccessRule;
use yii\helpers\ArrayHelper;

use app\models\Jenisdokumen;
use app\models\Sifatdokumen;
use app\models\Role;
use app\models\User;
use app\models\UserSearch;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data2 = $this->getSifatDokumen();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataSifatDokumen' => $data2,

        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $data2 = $this->getSifatDokumen();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataSifatDokumen' => $data2,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $data2 = $this->getSifatDokumen();
        $role = ArrayHelper::map(Role::find()->all(),'id_role', 'ket_role');
        if ($model->load(Yii::$app->request->post())) {
            $model->photo_user = UploadedFile::getInstance($model,'photo_user');
            $temp = $model->password;
            $model->password = Yii::$app->security->generatePasswordHash($temp);
            $model->authKey = Yii::$app->security->generateRandomString();
            $model->accessToken =Yii::$app->security->generateRandomString();
            $model->save();
            $model->photo_user->saveAs('uploads/image/' . $model->photo_user->baseName . '.' . $model->photo_user->extension);
            Yii::$app->getSession()->setFlash('success', [
           'text' => 'User Telah Disimpan',
           'title' => 'Tersimpan',
           'type' => 'success',
           'timer' => 3000,
           'showConfirmButton' => true
       ]);
            return $this->redirect(['view', 'id' => $model->id_user]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataSifatDokumen' => $data2,
                'dataRole' => $role,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data2 = $this->getSifatDokumen();
        $role = ArrayHelper::map(Role::find()->all(),'id_role', 'ket_role');
        if ($model->load(Yii::$app->request->post()) ) {
          $model->photo_user = UploadedFile::getInstance($model,'photo_user');
          $temp = $model->password;
          $model->password = Yii::$app->security->generatePasswordHash($temp);
          $model->save();
          if($model->photo_user != NULL)
          $model->photo_user->saveAs('uploads/image/' . $model->photo_user->baseName . '.' . $model->photo_user->extension);
          Yii::$app->getSession()->setFlash('success', [
         'text' => 'User Telah Diupdate',
         'title' => 'Tersimpan',
         'type' => 'success',
         'timer' => 3000,
         'showConfirmButton' => true
     ]);
            return $this->redirect(['view', 'id' => $model->id_user]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataSifatDokumen' => $data2,
                'dataRole' => $role,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('success', [
       'text' => 'User Telah Dihapus',
       'title' => 'Terhapus',
       'type' => 'success',
       'timer' => 3000,
       'showConfirmButton' => true
   ]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function getSifatDokumen()
    {
      return Sifatdokumen::find()->orderBy(['kode_sifat_dokumen'=>SORT_DESC])->all();
    }
}
