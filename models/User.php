<?php 

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * ContactForm is the model behind the contact form.
 */
class User extends ActiveRecord implements IdentityInterface
{


    public static function tableName()
    {
        return 'user';
    }

    public function getId()
    {
        return $this->user_id;
    }
    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }



    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    public function getPassword(){
        return $this->pass;
    }

    public function setPassword($password){
        $this->pass = Yii::$app->security->generatePasswordHash($password);
    }

    // return $this->pass === hash("sha256", $password);
    public function validatePassword($password,$hash)
    {
       return Yii::$app->security->validatePassword($password, $hash);

    }


    static function findByUsername($login){
        
        return static::findOne([
            'login'=> $login
        ]);
    }

}