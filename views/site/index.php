<?php 
use yii\helpers\Html;


foreach($goods as $i){  
    foreach($i['category'] as $j){
      echo  \yii\helpers\HtmlPurifier::process('<div class="work-block__case">
        <div class="work-block__title">
            <h2>'.$i['name'].'</h2>
        </div>
        <div class="work-block__image"><img src="img/'.$i['image'].'" alt="img"></div>
        <hr>
        <div class="work-block__category">'.$j['name_category'].'</div>
        <div class="work-block__count">Количество на складе: '.$i['count'].'</div>
        <div class="work-block__count">Цена: '.$i['price'].'</div>
        <div class="work-block__description">'.$i['description'].'</div>
        <div class="work-block__rating">Рейтинг: '.$i['rating'].'</div>
        <div class="work-block__link"><a href="#1">В корзину</a></div>
 
         <div class="work-block__right">
         </div>
         </div>');
    }   
}
?>


