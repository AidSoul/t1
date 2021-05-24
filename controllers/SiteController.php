<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
        $goods = new \app\models\tables\Goods;
        $this->view->title = 'POTTERY';
        return $this->render('index', ['goods'=>$goods->receiveGoods()]);
    }

   public function actionAbout()
    {
        $this->view->title = 'О нас';

        return $this->render('about');
    }

    public function actionBasket()
    {
        $this->view->title = 'Корзина';
 
        return $this->render('basket');
    }
    

}
