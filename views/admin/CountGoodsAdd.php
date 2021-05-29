<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Notification;
use yii\widgets\MaskedInput;
?>
<div class="width-all">
<?php $form = ActiveForm::begin(['options'=>['class'=>'form']]) ?>
<?= $form->field($model, 'count')?>
<br>
<?= Html::submitButton('Добавить',['class'=>'btn btn-primary'])?>
<?php $form = ActiveForm::end() ?>
</div>