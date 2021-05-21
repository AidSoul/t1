<?php
namespace app\models;

use yii\base\Model;

class LoginForm extends Model 
{

    public $login;
    public $pass;

    public function attributeLabels()
    {
      return [
          'login' => 'Логин',
          'pass' => 'Пароль'
      ]  ;
    }

    public function rules(){
        return [
          [  [ 'login', 'pass' ], 'required'],
          [ ['login','pass'], 'string','length' => [5,25] ]
        ];
    }

}