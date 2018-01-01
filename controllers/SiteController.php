<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\components\AccessRule;

use app\models\LoginForm;
use app\models\Sifatdokumen;
use app\models\User;


class SiteController extends Controller
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
                'only' => ['logout','index'],
                'rules' => [
                  //nek wes login
                    [
                        'actions' => ['logout','index','change'],
                        'allow' => true,
                        'roles' =>
                        [
                        User::ROLE_ADMIN,
                        User::ROLE_OPERATOR,
                      ],
                    ],

                    //nek rung login
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
      $data2 = $this->getSifatDokumen();
      return $this->render('index', [
          'dataSifatDokumen' => $data2,
      ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
      $data2 = $this->getSifatDokumen();
        if (!Yii::$app->user->isGuest) {

          return $this->render('index', [
              'dataSifatDokumen' => $data2,
          ]);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->renderPartial('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionChange()
    {
        $model = User::find()->where(['username'=>Yii::$app->user->identity->username])->one();
        $data2 = $this->getSifatDokumen();
        if ($model->load(Yii::$app->request->post())) {
            $temp = $model->password;
            $model->password = Yii::$app->security->generatePasswordHash($temp);
            $model->save();
            return $this->render('index',[
            'dataSifatDokumen' => $data2,
          ]);
        }else{
        return $this->render('change', [
                'model'=>$model,
                'dataSifatDokumen' => $data2,
            ]
        );
    }}

    public function getSifatDokumen()
    {
      return Sifatdokumen::find()->orderBy(['kode_sifat_dokumen'=>SORT_DESC])->all();
    }
}
