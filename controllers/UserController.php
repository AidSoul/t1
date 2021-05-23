<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;

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
        $model = new \app\models\LoginForm;
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
            // данные не корректны: $errors - массив содержащий сообщения об ошибках
            $errors = $model->errors;
        }

        $this->view->title = 'Вход';
        return $this->render('login', compact('model'));
    }

    public function actionSignup()
    {
        
        $model = new \app\models\SignupForm;
        $model->load(\Yii::$app->request->post());

        if($model->validate()){
            $user = User::find()->where(['login' => $model->login])->one();
            if(!empty($user)){
                Yii::$app->session->setFlash('notifi','Пользователь с таким логином уже существует!');
            }
            else{
                if(!empty(User::find()->where(['email' => $model->email])->one())){
                    Yii::$app->session->setFlash('error','Пользователь с таким email уже существует!'); 
                }
                else{
                    
                    $user = new User();
                    $user->generateAuthKey();
                    $user->login = $model->login;
                    $user->setPassword($model->pass);
                    $user->f = $model->f;
                    $user->i = $model->i;
                    $user->o = $model->o;
                    $user->status = 0;
                    $user->email = $model->email;
                    $user->phone = $model->phone;
                    $user->save();

                    $auth = Yii::$app->authManager;
                    $authorRole = $auth->getRole('author');
                    $auth->assign($authorRole, $user->status);

                    return $this->goHome();
                }
            }
        }
        else{          
            $errors = $model->errors;
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