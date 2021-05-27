<?php 
use yii\helpers\Html;
use app\components\Notification;
use app\components\Rating;
?>
<?php echo Notification::widget(); ?>
<section class="work-block">

<?php
if(!$goods[0]){
  echo $goods[1];
}
// \yii\helpers\HtmlPurifier::process()
else{
  foreach($goods as $i){  
    foreach($i['category'] as $j){
      echo  '<div class="work-block__case">
        <div class="work-block__title">
            <h2>'.$i['name'].'</h2>
        </div>
        <div class="work-block__image"><img src="img/'.$i['image'].'" alt="Image: '.$i['name'].'"></div>
        <div class="design">
        <div class="work-block__category">'.$j['name_category'].'</div>
        <div class="work-block__count">Количество на складе: '.$i['count'].'</div>
        <div class="work-block__count">Цена: '.$i['price'].'</div>
        <div class="work-block__description">'.$i['description'].'</div>
        <div class="work-block__rating">'.Rating::widget(['star'=>$i['rating']]).'</div>
        <div class="work-block__link">'.Html::a('В корзину',['/add-basket?product='.base64_encode($i['id_goods'])]).'</div>
        <br>
        <div class="work-block__link">'.Html::a('Удалить',['/product-remove?remove='.base64_encode($i['id_goods']).'&image='.base64_encode($i['image'])]).'</div>
        </div>
         </div>';
    }   
}
}

?>
        </section>
