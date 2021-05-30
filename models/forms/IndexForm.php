<?php
namespace app\models\forms;

use yii\base\Model;


class IndexForm extends Model {

    public $search;
    public $name;
    public $typeSeacrch;

    public function attributeLabels()
    {
      return [
          'search' => 'Текст поиска:',
          'typeSeacrch' => 'Критерии поиска',
      ];
    }

    public function rules(){
        return [
          [['search'], 'required'],
          [ ['search'], 'string','length' => [1,55] ],
        ];
    }
}
