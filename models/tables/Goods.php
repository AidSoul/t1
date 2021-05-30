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

    public static function findIdOne($idGoods){

        return parent::findOne(['id_goods'=>$idGoods]);
    }

    public function searchNameOne(){
        return $this->find()->select(['id_goods','name'])->asArray()->all();
    }

    public function searchName($search)
    {
            return $this->find()->where(['like','id_goods',$search])->InnerJoinWith(Category::tableName())->asArray()->all();   
    }

    public function receiveGoods($sort)
    {

            return $this->find()->InnerJoinWith(Category::tableName())->orderBy($sort->orders)->asArray()->all();
        
      
    }

    // public function receiveGoodsAsArray()
    // {
        
    //     return $this->find()->InnerJoinWith(Category::tableName())->orderBy($sort->orders)->asArray()->all();
    // }

    public function addGoods($model)
    {
      $this->name = $model->name;
      $this->image = $model->randomFileName();
      $this->price = $model->price;
      $this->description = $model->description;
      $this->count = $model->count;
      $this->rating = 0;
      $this->category_id = base64_decode($model->category) + 1;
      $this->save();
    }

    public function removeGoods($id = 0,$img = 0)
    {
       $a = $this->findOne(['id_goods'=>base64_decode($id)]);
       if($a){
        $a->delete();
        unlink(Yii::$app->basePath . '/web/img/' .base64_decode($img));
       }
       

       
    }
    
    public function addСount($model,$id)
    {   
        $find = $this->findOne(['id_goods'=>base64_decode($id)]);  
        $find ->count = $model->count;
        $find ->save();
    }

    public function removeСount($count,$id)
    {
        $this->findOne(['id_goods'=>base64_decode($id)]);
        $this->count =  $this->count-$count;
        $this->delete();
    }
}