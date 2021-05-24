<?php

namespace app\models\additional;

use Yii;
use yii\base\Model;

class UserFuntion extends Model 
{


    private function userArr(){

        return [
                'login'  => 'логином',
                'email'  => 'email',
                'phone'  => 'телефона'       
               ];

    }

    private function creatSession($errorName){
        Yii::$app->session->setFlash('notifi',"Пользователь с таким {$errorName} уже существует!");
    }

    public function checkCreateUser($data, $model = [null])
    {
        $user = new \app\models\tables\User;
            
            foreach($this->userArr() as $key=>$value){
                foreach($data as $keyU=>$valueU){
                    if($key == $keyU){
                        if(!empty($user->findUserBy([$keyU=>$valueU]))){    
                            $this->creatSession($value);     
                            return false;   
                            break;
                         }                   
                    }
                    else{
                        $user->createUser($model);
                        return true;
                    }
              
                }
    
            }
    
    }



}