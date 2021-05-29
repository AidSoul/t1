<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\components\AddNotifi;

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
        $goods = $goods->receiveGoods();
        
        if(!$goods){
            $goods = [false,'Нет товаров'];
        }

        $this->view->title = 'POTTERY';
        return $this->render('index', ['goods'=>  $goods]);
    }

   public function actionAbout()
    {
        $this->view->title = 'О нас';

        return $this->render('about');
    }

    public function actionComment($product = null, $remove = null)
    {
            $model = new \app\models\forms\CommentForm;
            $model->load(\Yii::$app->request->post());
            $comment = new \app\models\tables\Comment($product);

            $comments = $comment->showComments();   
            if($remove){
            $comment->removeComments(base64_decode($remove));        
            AddNotifi::widget(['type'=>'success','message'=>'Комментарий удалён!']); 
            }              
            if($model->validate()){
                $comment->addComments($model);
                AddNotifi::widget(['type'=>'success','message'=>'Комментарий добавлен']);
                $this->refresh();
              
            }
            return $this->render('comment', ['model'=>  $model, 'comments'=> $comments]);
    }

    //  public function actionCommentRemove($url = null, $remove = null)
    //         {               
    //             $comment = new \app\models\tables\Comment;
    //             if($remove){
    //                 $comment->removeComments(base64_decode($remove));
    //                 AddNotifi::widget(['type'=>'success','message'=>'Комментарий удалён!']); 
                    
    //              return $this->render('comment');
    //         }

    //         }
}
