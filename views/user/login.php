<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\Notifications;

?>
<?php 
    echo Notifications::widget(['type'=>'danger','message'=>Yii::$app->session->getFlash('notifi')]);
?> 
<?php $form = ActiveForm::begin(['options'=>['class'=>'form']]) ?>
<?= $form->field($model, 'login')?>
<?= $form->field($model, 'pass')->passwordInput()?>
<br>
<?= Html::submitButton('Вход',['class'=>'btn btn-primary'])?>
<?php $form = ActiveForm::end() ?>

