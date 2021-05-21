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
                'only' => ['logout'],
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
            if(!Yii::$app->user->isGuest){
                return $this->goHome();
                
            }

        $model = new \app\models\LoginForm;
        $user = new User;

       $model->load(\Yii::$app->request->post());

            if($model->validate()){
                                            
                $identity = $user->findByUsername($model->login);
                if(!empty($identity)){   
                    if($user->validatePassword($model->pass,$identity->pass)){              
                        Yii::$app->user->login($identity,3600*24*30);
                        
                        Yii::$app->session->setFlash('success',"Успех");
                    }
                    else{
                        Yii::$app->session->setFlash('error',"Не прошёл валидацию пароля!");
                    }
                    
                }
                else{
                    Yii::$app->session->setFlash('error','Пользователей нет!');
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
        
        // $modele = User::find()->where(['login' => 'admin'])->one();
        // if (empty($modele)) {
    
        //     $user = new User();
        //     $user->generateAuthKey();
        //     $user->login = 'admin';
        //     $user->setPassword('admin');
        //     $user->f = 'Фамилия';
        //     $user->i = 'Имя';
        //     $user->o = 'Отчество';
        //     $user->status = 1;
        //     $user->email = 'admin@admin.com';
        //     $user->phone = '+375294466222';
        //     $user->save();
        // }


        // $identity = Yii::$app->user->identity;
        // if($identity){
        //     $asc = 'Дааа';
        // }
        // else{
        //     $asc = 'Неаа';
        // }
        $asc = Yii::$app->user->id;


        $data = User::find()->asArray()->where(['login'=> 'admin'])->limit(1)->one();

        $this->view->title = 'Регистрация';
        // return $this->render('signup',compact('data'));
        return $this->render('signup',['asc'=>$asc]);
    }

    public function actionLogout(){
        if(isset(Yii::$app->user->identity)){
            Yii::$app->user->logout();
        } 
        $this->view->title = 'Выход';
        return $this->render('logout');
    }
    
     
}