<?php
namespace app\models\forms;

use yii\base\Model;


class CountGoodsForm extends Model {

    public $count;

    public function attributeLabels()
    {
      return [
          'count' => 'Количество товара',
      ];
    }

    public function rules(){
        return [
          [['count'], 'required'],
          [['count'],'integer'],
        ];
    }
}
