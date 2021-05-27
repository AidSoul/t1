<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Notification;
use yii\widgets\MaskedInput;
?>

 <?php 
 $category =  new \app\models\tables\Category;

 ?>
 <div class="width-all">
 <?php
      echo Notification::widget();
 ?>
 <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?= $form->field($model, 'name')?>
<br>
<?= Html::submitButton('Добавить',['class'=>'btn btn-primary'])?>
<?php $form = ActiveForm::end() ?>
</div>
<?php 
?>