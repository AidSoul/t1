<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
echo $product;
?>

<div class="width-all">
<?php $form = ActiveForm::begin(['options'=>['class'=>'form']]) 
?>
<?= $form->field($model, 'text')->textarea()?>
<br>
<?= Html::submitButton('Добавить',['class'=>'btn btn-primary'])?>
<?php $form = ActiveForm::end() ?>
</div>