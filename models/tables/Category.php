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
}