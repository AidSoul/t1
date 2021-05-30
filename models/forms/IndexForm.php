<?php
namespace app\models\forms;

use yii\base\Model;


class IndexForm extends Model {

    public $search;
    public $typeSeacrch;
    public $typeSorting;

    public function attributeLabels()
    {
      return [
          'search' => 'Текст поиска:',
          'typeSeacrch' => 'Критерии поиска',
          'typeSorting' => 'Сортировка'
      ];
    }

    public function rules(){
        return [
          [['search'], 'required'],
          [ ['search'], 'string','length' => [1,25] ],
        ];
    }
}
