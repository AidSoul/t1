<?php
namespace app\components;

use Yii;

class User extends \yii\web\User
{
    private function userExistenceCheck(){
        $status = null;
        if(empty(Yii::$app->user->identity)){
            $status = false;
        }
        else{
            $status = true;
        }
        return $status;
    }

    public function getlogin()
    {
        if($this->userExistenceCheck()){
            return \Yii::$app->user->identity->login;
        }
      
    }

    public function getfio()
    {
        if($this->userExistenceCheck()){
        $user = \Yii::$app->user->identity;
        $fio = "{$user->f} {$user->i} {$user->o}";
        return $fio;
        }
        
    }


    public function getStatus()
    {
        if($this->userExistenceCheck()){
        return \Yii::$app->user->identity->status;
    }
    }
}