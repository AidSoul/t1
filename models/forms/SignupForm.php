<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;


class SignupForm extends Model 
{

    public $login;
    public $pass;
    public $f;
    public $o;
    public $i;
    public $email;
    public $phone;


    public function attributeLabels()
    {
      return [
          'login' => 'Логин',
          'pass' => 'Пароль',
          'f' => 'Фамилия',
          'i' => 'Имя',
          'o' => 'Отчество',
          'email' => 'Почта',
          'phone' => 'Телефон',
      ];
    }

    public function rules(){
        return [
          [  [ 'login', 'pass','f','i','o','email','phone' ], 'required'],
          [ ['login','pass'], 'string','length' => [5,25]],
          [ 'login','match', 'pattern' => '/^[a-z][a-z0-9]*$/i', 'message' => 'могут быть буквы и цифры, первый символ обязательно буква!'],
          [ 'pass','match', 'pattern' => '/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{5,}/', 'message' => 'Строчные и прописные латинские буквы, цифры, спецсимволы'],
          [ ['f','i','o'], 'string','length' => [2,35] ],
          ['email','email'],
        ];
    }

}