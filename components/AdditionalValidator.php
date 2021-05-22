<?php
namespace app\components;
use yii\validators\Validator;

class AdditionalValidator extends Validator
{

    public function removeLatin($model, $attribute)
    {
        if(!preg_match('/^[a-zA-Z]$/i',$model->$attribute)){
            $this->addError($model, $attribute, 'должен содержать только латиницу.');
        }
         
    }
}