<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\tables\User;
use app\components\AddNotifi;


class UserController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                // 'denyCallback' => function ($rule, $action) {
                //   echo 'У вас нет доступа к этой странице';
                // },
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout','basket'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        // admiN$1
       $model = new \app\models\forms\LoginForm;
       $user = new User;
       $model->load(\Yii::$app->request->post());

            if($model->validate()){
                                            
                $identity = $user->findByUsername($model->login);
                if(!empty($identity)){   
                    if($user->validatePassword($model->pass,$identity->pass)){              
                        Yii::$app->user->login($identity,3600*24*30);      
                        return $this->goHome();
                    }
                    else{
                        AddNotifi::widget(['type'=>'danger','message'=>'Не прошёл валидацию пароля!']);
                    }
                    
                }
                else{
                    AddNotifi::widget(['type'=>'danger','message'=>'Нет такого пользователя!']);
                }

                }
         else {
            $errors = $model->errors;
        }

        $this->view->title = 'Вход';
        return $this->render('login', compact('model'));
    }

    public function actionSignup()
    {
        
        $model = new \app\models\forms\SignupForm;
        $model->load(\Yii::$app->request->post());
        
        if($model->validate()){
            $chekUser = new \app\models\additionals\UserFuntion;
            if($chekUser->checkCreateUser([
            'login' => $model->login,
            'email' => $model->email,
            'phone' => $model->phone,
            ],$model))
            {
            
              return $this->goHome();     
        }
        else{          
            $errors = $model->errors;
        }

    }
    $this->view->title = 'Регистрация';
    return $this->render('signup',compact('model'));
     
    }

    // Выход
    public function actionLogout(){

        if(isset(Yii::$app->user->identity)){
            $basket = new  \app\models\tables\Basket(1);
            $basket->removeAllGoodsInBasket();
            Yii::$app->user->logout();
        } 
        $this->goHome();
    }

    // Добавление в корзину товара
    public function actionAddBasket($product)
    {
        if(isset(Yii::$app->user->identity)){
        $basket = new  \app\models\tables\Basket($product);
        $basket->addInBasket();
        AddNotifi::widget(['type'=>'success','message'=>'Товар добавлен в корзину!']);

      
        $this->goHome();
        }
        else{
            AddNotifi::widget(['type'=>'danger','message'=>'Авторизуйтесь, чтобы добовлять товары в корзину!']);
            $this->goHome();
        }
    }

    // Убрать товар из корзины
    // Не нужно в данный момент
    public function actionRemoveBasket($product)
    {
        $basket = new  \app\models\tables\Basket($product);
        $basket->removeOfBasket();
        AddNotifi::widget(['type'=>'danger','message'=>'Одним товаром стало меньше!']);
    }
        

    // Показать корзину
    public function actionBasket($goods = null)
    {
        if(isset(Yii::$app->user->identity)){
        $model = new \app\models\forms\BasketForm;
        $model->load(\Yii::$app->request->post());
       
        // $baskets = new  \app\models\additionals\BasketFunction(base64_decode($add));
        // $baskets->add();
        // $removeGoods =  $baskets->removeOne();
        // $baskets->delete();

        $basket = new  \app\models\tables\Basket($goods);
        if($model->validate()){
        
        }
        if($goods){
            $goods = explode('$',$goods,2);
            list($goods,$type) = $goods;
           
            switch($type){
                case 'a':
                    $add =   $basket->addInBasket();
                    if($add){
                        AddNotifi::widget(['type'=>'success','message'=>'Количество товара увеличилось']);
                    }

                   
                break;
                case 'r':
                    $removeGoods =  $basket->removeOfBasket();
                    AddNotifi::widget(['type'=>$removeGoods[0],'message'=>$removeGoods[1]]);
                break;
                case 'd':
                    $basket->removeGoods();
                    AddNotifi::widget(['type'=>'danger','message'=>'Товар убран из корзины!']);
                break;         
                case 'ok':
                    $basket->removeAllGoodsInBasket();
                    AddNotifi::widget(['type'=>'success','message'=>'Спасибо, ваш заказ принят!']);
                break;         
            }
               
        }
        $this->view->title = 'Корзина';
        return $this->render('basket',['model'=>$model,'basket'=> $basket->receiveBasket()]);
    }
    else{
        AddNotifi::widget(['type'=>'danger','message'=>'Нужно авторизироваться, для просмотра корзины! ']);
        $this->goHome();
    }
    }

}