<?php 
use yii\helpers\Html;
use app\components\Notification;
use app\components\Rating;
use app\models\tables\Goods;

?>
<?php echo Notification::widget(); ?>
<section class="work-block">

<?php
function adminUserFun($type,$id,$img = null){
  $id = base64_encode($id);
  switch($type){
    case 'user':
      if($img > 0){
        if(isset(Yii::$app->user->identity)){
          return Html::a('В корзину ',['/add-basket?product='.$id]);

        }  
      }
      else{
        return '<span class="red-span">Нет в наличии<span>';
      }

      break;

    case 'admin':
     
      if(Yii::$app->user->getStatus() === 1){
        if($img == 1) {
          return Html::a('✎',['/add-count?product='.$id]);
        }
        else{
          return Html::a('Удалить',['/product-remove?remove='.$id.'&image='.$img]);
        }
      
      }
      else{
        return '';
      }
      break;
  }


}


if(!$goods[0]){
  echo $goods[1];
}
// \yii\helpers\HtmlPurifier::process()
else{
  foreach($goods as $i){  
    foreach($i['category'] as $j){
      $count = $i['count'];
      $idGoods = $i['id_goods'];
      $img = $i['image'];
      // if($count == 0){
      //   $count = 'Нет в наличии';
      // }
      echo  '<div class="work-block__case">
        <div class="work-block__title">
            <h2>'.$i['name'].'</h2>
        </div>
        <div class="work-block__image"><img src="img/'.$i['image'].'" alt="Image: '.$i['name'].'"></div>
        <div class="design">
        <div class="work-block__category">'.$j['name_category'].'</div>
        <div class="work-block__count">Количество: '.adminUserFun('admin', $idGoods, 1).$count.'</div>
        <div class="work-block__count">Цена: '.$i['price'].'</div>
        <div class="work-block__description">'.$i['description'].'</div>
        <div class="work-block__rating">'.Rating::widget(['star'=>$i['rating']]).'</div>
        <div class="work-block__link">'.adminUserFun('user', $idGoods, $count).'</div>
        <div class="work-block__link">'.Html::a('Комментарии',['/comment?product='.base64_encode( $idGoods )]).'</div>
        <div class="work-block__link">'.adminUserFun('admin', $idGoods,$img).'</div>
        </div>
         </div>';
    }   
}
}

?>
        </section>
