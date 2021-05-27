<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;
?>
<div class="width-all">

<?php $form = ActiveForm::begin(['options'=>['class'=>'form']]) ?>
<?= $form->field($model, 'login')?>
<?= $form->field($model, 'pass')->passwordInput()?>
<?= $form->field($model, 'f')?>
<?= $form->field($model, 'i')?>
<?= $form->field($model, 'o')?>
<?= $form->field($model, 'email')->input('email')?>
<?= $form->field($model, 'phone')->widget(MaskedInput::className(),['mask'=>'+375 (99) 999-99-99'])->textInput(['placeholder'=>'+375 (29) 999-99-99'])?>
<br>
<?= Html::submitButton('Создать',['class'=>'btn btn-primary'])?>
<?php $form = ActiveForm::end() ?>
</div>

