<?php
namespace app\models\forms;

use yii\base\Model;


class CategoryAddForm extends Model 
{
    public $name;

    public function attributeLabels()
    {
      return [
          'name' => 'Название категории',
      ];
    }

    public function rules(){
        return [
          [['name'], 'required'],
          [['name'],'string','length'=> [1,35]]
        ];
    }
}