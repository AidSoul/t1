<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\tables\User;

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
                        'actions' => ['logout'],
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
                        Yii::$app->session->setFlash('notifi',"Не прошёл валидацию пароля!");
                    }
                    
                }
                else{
                    Yii::$app->session->setFlash('notifi','Нет такого пользователя!');
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
            $chekUser = new \app\models\additional\UserFuntion;
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

    public function actionLogout(){
        if(isset(Yii::$app->user->identity)){
            Yii::$app->user->logout();
        } 
        $this->view->title = 'Выход';
        return $this->render('logout');
    }
    
     
}