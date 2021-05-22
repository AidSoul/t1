<?php 
namespace app\components;
use yii;
use yii\base\Widget;

class Notifications extends Widget
{
    // danger
    // success

    public $type;
    public $message;


    public function init()
    {        
    if($this->type === null && $this->message === null){
        $this->type = 'success';
        $this->message = 'Всё Оки';
        parent::init();
    }   
    }

    public function run()
    {    
        if(Yii::$app->session->hasFlash('notifi')){
            $ret =  '<div class="alert alert-'.$this->type.'" role="alert">'.$this->message .'</div>';
            Yii::$app->session->destroy('notifi');
            return $ret;
        }
        
    
    }
}

