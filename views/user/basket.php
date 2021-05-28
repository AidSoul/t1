<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
  <div class="width-all">

<table class="table">
    <tr>
      <th>Название</th>
      <th>Количество</th>
      <th>Цена</th>
      <th>Полная цена</th>
      <th></th>
    </tr>
<?php 
if($basket){
  $arrBasket = ['total-price'=>0];
  foreach($basket as $i){
    foreach($i['goods'] as $goods){  
      $totalPrice = $goods['price']*$i['count'];
      $idPr = base64_encode($goods['id_goods']);
      $arrBasket['total-price'] += $totalPrice;
      echo '
      <tbody>
        <tr>
          <td>'.$goods['name'].'</td>
          <td>'.Html::a('&#9668;',['/basket?goods='.$idPr.'$r']).' '.$i['count'].' '.
                Html::a('&#9658;	',['/basket?goods='.$idPr.'$a']).'</td>
          <td>'.$goods['price'].'</td>  
          <td>'.$totalPrice.'</td>  
          <td>'. Html::a('&#10060;	',['/basket?goods='.$idPr.'$d']).'</td>  
        </tr>
      </tbody>
    ';
    }
  } 
?>
</table>
<hr>
<div class="total-price">
<?php echo '<b>Итоговая цена: </b><span>'.$arrBasket['total-price'].'</span>';?>
</div>
<br>
<p>
<?php echo Html::a('Оформить заказ',['/basket?goods='.$idPr.'$ok']);?>
</p>
<?php
}
else{
  echo 'Корзина пуста!';
}

?> 


</div>

