<?php

namespace app\models\tables;
use Yii;
use yii\db\ActiveRecord;


class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['category_id' => 'id_category']);
    }

    public static function getNameCategory(){
        $items = [];
        foreach(parent::find()->asArray()->all() as $i=>$v){
           $items[base64_encode($v['id_category'])] = $v['name_category'];
        }
        return $items;
    }

    public function addCategory($model){
        $this->name_category = $model;
        $this->save();
    }
    

}