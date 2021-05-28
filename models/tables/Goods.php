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

    public function addGoods($model)
    {
      $this->name = $model->name;
      $this->image = $model->randomFileName();
      $this->price = $model->price;
      $this->description = $model->description;
      $this->count = $model->count;
      $this->rating = 0;
      $this->category_id = base64_decode($model->category);
      $this->save();
    }
    public function removeGoods($id = 1,$img = 1)
    {
        $this->find()
        ->where(['id_goods'=>base64_decode($id)])
        ->one()
        ->delete();
        unlink(Yii::$app->basePath . '/web/img/' .base64_decode($img));
    }

}