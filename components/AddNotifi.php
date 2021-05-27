<?php
namespace app\components;
use yii;
use yii\base\Widget;

class AddNotifi extends Widget
{
    // danger
    // success

    public $type;
    public $message;

    public function init()
    {        
        parent::init();     
      
    }   

    public function run()
    {    
        Yii::$app->session->setFlash(Notification::$flashName,[$this->type,$this->message]);
    }
}
