<?php 

namespace app\models\tables;
use Yii;
use yii\db\ActiveRecord;


class Goods extends ActiveRecord
{
    public static function tableName()
    {
        return 'goods';
    }

    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id_category' => 'category_id']);
    }

    public function receiveGoods()
    {
       return $this->find()->InnerJoinWith(Category::tableName())->asArray()->all();
    }
}