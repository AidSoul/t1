<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
  <div class="width-all">
<?php $form = ActiveForm::begin(['options'=>['class'=>'form']]) ?>
<?= $form->field($model, 'login')?>
<?= $form->field($model, 'pass')->passwordInput()?>
<br>
<?= Html::submitButton('Вход',['class'=>'btn btn-primary'])?>
<?php $form = ActiveForm::end() ?>
</div>