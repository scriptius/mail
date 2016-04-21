<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UserForm;
use app\mail\Mailer;

class SiteController extends Controller
{
    public $chain = [];
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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

    public function actionIndex()
    {
        $model = new UserForm();
               if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new \app\models\User();
            $user->attributes = Yii::$app->request->post('UserForm');
            $user->save();
            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            return $this->render('entry', ['model' => $model]);
        }

        $config = require(__DIR__ . '/../config/params.php');
        return $this->render('index',['domain' => $config['domain']]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $user = new \app\models\User();
        $user->firstName = 'Иванов';
        $user->lastName = 'Иван';
        $user->patronymic = 'Иванович';
        $user->email = 'test@example.com';
        echo($user->getFullName());
//        $allProperty = get_object_vars(Yii::$app);
//        var_dump($allProperty);
//        die;
//        foreach ($allProperty as $object){
//            if (is_object($object)){
//               var_dump( $this->getChainObjects($object));
//            }
//            else{
//                echo 0;
//            }
        }

//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//
//            return $this->refresh();
//        }
//        return $this->render('contact', [
//            'model' => $model,
//        ]);
//    }
 public function getChainObjects($object)
 {
//     var_dump($object->chain);
//     die;
     $allProperty = get_object_vars(Yii::$app);

     foreach ($allProperty as $object) {
         if (is_object($object)) {
           $this->chain[] = get_class($object);
//          $this->getChainObjects($object);
         }
     }
     return $this->chain;
 }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionMail()
    {
        $mail = new Mailer();
        $mail->Send();
        return $this->render('mail');
    }
}
