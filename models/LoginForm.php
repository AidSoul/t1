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
          [ ['login','pass'], 'string','length' => [5,25] ],
          [ 'login','match', 'pattern' => '/^[a-z][a-z0-9]*$/i', 'message' => 'могут быть буквы и цифры, первый символ обязательно буква!'],
          [ 'pass','match', 'pattern' => '/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{5,}/', 'message' => 'Строчные и прописные латинские буквы, цифры, спецсимволы'],
        ];
    }

}