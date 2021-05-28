<?php

namespace app\models\tables;

use Users;
use Yii;
use yii\db\ActiveRecord;

class Comment extends ActiveRecord{

    public static function tableName()
    {
        return 'comment';
    }

    private $goodsId = null;
    private $userId = null;

    public function __construct($goods = null)
    {
        $this->goodsId = base64_decode($goods);
        $user = Yii::$app->user->userId();
        if( $user ){
            $this->userId =  $user;
        }
    }


    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['id_goods' => 'goods_id']);
    }

    public function getUser()
    {
        return $this->hasMany(User::className(), ['id_user' => 'user_id']);
    }

    public function showComments($table = ''){
        return $this->find($table)
        ->where(['goods_id'=> $this->goodsId])
        ->InnerJoinWith(Goods::tableName())
        ->InnerJoinWith(User::tableName())
        ->asArray()->all();

    }

    public function addComments($model){
        
       $this->data_comment = date("Y-m-d H:i:s");
       $this->comment_text = $model->text;
       $this->rating_user = $model->rating;
       $this->goods_id = $this->goodsId;
       $this->user_id = $this->userId;
       $this->save();

       // Обновления рейтинга товара

       $rating = 0;

        $f = $this->find('rating_user')
        ->where(['goods_id'=> $this->goodsId])
        ->asArray()
        ->all();

        foreach($f as $i){
            $rating += $i['rating_user'];
        }

        $count = count($f);
        if($count > 0){
            $rating = round($rating/ $count);
        }
        else{
            $rating = 0;
        }

        $u = Goods::find('count')->where(['id_goods'=>$this->goodsId])->one();
        $u->rating = $rating;
        $u->save();
    }

    public function removeComments($id){
            
            $f = $this->find()->where(['id_comment'=>$id])
            ->one();
            if(!empty($f)){
                $f->delete();    
            }
           
    }

}