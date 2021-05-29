<?php
namespace app\models\forms;

use yii\base\Model;


class IndexForm extends Model {

    public $search;

    public function attributeLabels()
    {
      return [
          'search' => 'Поиск',
      ];
    }

    public function rules(){
        return [
          [['search'], 'required'],
          [['search'],'integer'],
        ];
    }
}
