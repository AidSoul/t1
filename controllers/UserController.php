gdfg
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

    public function actionLogin()
    {
       
            if(!Yii::$app->user->isGuest){
                return $this->goHome();
                
            }

        $model = new \app\models\LoginForm;
       $model->load(\Yii::$app->request->post());
            if($model->validate()){
               
                $user = User::find()->asArray()->where(['login'=>$model->login])->limit(1)->one();
                if($user){
                    Yii::$app->session->setFlash('user', $user);
                    if($user['pass'] == $model->pass ){
                        
                        Yii::$app->session->setFlash('success',"Привет, {$user['f']} {$user['i']} {$user['o']}");
                    }
                    else{
                        Yii::$app->session->setFlash('error','Неверный пароль');
                    }
                }
                else {
                    Yii::$app->session->setFlash('error','Нет такого пользователя');
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

        $data = User::find()->asArray()->where(['login'=> 'admin'])->limit(1)->one();

        $this->view->title = 'Регистрация';
        return $this->render('signup',compact('data'));
    }
     
}