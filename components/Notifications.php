<?php 
namespace app\components;

use yii\base\Widget;

class Notifications extends Widget
{
    // danger
    // success

    public $type;
    public $message;

    public function init()
    {
        parent::init();
        if($this->type === null && $this->message === null){
            $this->type = 'success';
            $this->message = 'Всё Оки';
        }
    }
    public function run()
    {
        return '<div class="alert alert-'.$this->type.'" role="alert">'.$this->message .'</div>';
    }
}

