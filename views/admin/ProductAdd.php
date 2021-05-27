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
<?= $form->field($model, 'category')->dropDownList($category->getNameCategory())?>

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