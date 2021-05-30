<?php

namespace app\models\additionals;

use Yii;
use yii\base\Model;
use app\components\AddNotifi;

class SearchSortFunction extends Model 
{

    public function __construct()
    {

    }

    public static function search($name){
        
    $search = new \app\models\tables\Goods;

     return  $search->find()->where(['name'=>$name])->asArray()->limit(3);

    }

    private function sortAttributes($sortName = null, $label = null)
    {
       return [
        'asc' => [$sortName => SORT_ASC],
       'desc' => [$sortName => SORT_DESC],
       'default' => SORT_DESC,
       'label' => $label
    ];
    }

    public  function sort(){
        $sort = new  \yii\data\Sort([
            'attributes' => [
                'rating' => $this->sortAttributes('rating','Рейтинг'),
                'name' => $this->sortAttributes('name','Название Товара'),
             
                'count' => $this->sortAttributes('count','Количество на складе'),

            ],
        ],
            );   
        return $sort;
    }

}
