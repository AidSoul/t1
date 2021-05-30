<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Notification;
use yii\widgets\MaskedInput;
use app\models\tables\Category;
?>

 <?php 

 ?>
 <div class="width-all">
 <?php
        echo Notification::widget();
 ?>
 <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?= $form->field($model, 'name')?>
<?= $form->field($model, 'category')->dropDownList(Category::getNameCategory())?>

<?= $form->field($model, 'description')->textarea()?>
<?= $form->field($model, 'image')->fileInput()?>
<?= $form->field($model, 'count')?>
<?= $form->field($model, 'price')?>

<br>
<?= Html::submitButton('Добавить товар',['class'=>'btn btn-primary'])?>
<?php $form = ActiveForm::end() ?>
</div>
<?php 
?>