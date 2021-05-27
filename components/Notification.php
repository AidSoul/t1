<?php 
namespace app\components;
use yii;
use yii\base\Widget;

class Notification extends Widget
{
    // danger
    // success

    public $type = 0;
    public $message = 0;
    public static $flashName = 'notifi';

    public function init()
    {        
      
    }   

    public function getFlashData(){

     $data =  Yii::$app->session->getFlash(self::$flashName);
     $this->type = $data[0];
     $this->message = $data[1];
    }

    public function run()
    {        
        if(Yii::$app->session->hasFlash(self::$flashName)){
        $this->getFlashData();
        $ret =  '<div style="text-align:center" class="alert alert-'.$this->type.'" role="alert">'.$this->message .'</div>';
        Yii::$app->session->destroy(self::$flashName);
        return  \yii\helpers\HtmlPurifier::process($ret);  
    }
    
    }
}

